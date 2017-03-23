<?php namespace Zeropingheroes\Lanager\Domain\ApplicationUsage;

use Zeropingheroes\Lanager\Domain\States\StateService;
use Zeropingheroes\Lanager\Domain\Applications\ApplicationTransformer;
use Zeropingheroes\Lanager\Domain\Users\UserTransformer;
use Config;
use Cache;

class ApplicationUsageService {

	/**
	 * State service class
	 * @var object StateService
	 */
	protected $states;

	/**
	 * Class responsible for transforming application data
	 * @var object
	 */
	protected $applicationTransformer;

	/**
	 * Class responsible for transforming user data
	 * @var object
	 */
	protected $userTransformer;

	/**
	 * Pull in the services and transformers required
	 */
	public function __construct()
	{
		$this->states = new StateService;
		$this->applicationTransformer = new ApplicationTransformer;
		$this->userTransformer = new UserTransformer;
	}

	/**
	 * Calculate the total number of users playing each game at a given timestamp
	 * @param  int $timestamp UNIX timestamp
	 * @return array $applications	Applications in use and the users using them
	 */
	public function userTotalsAt( $timestamp )
	{
		//Note to future self:
		//This is timestamp hash to correlate to the nearest steam polling interval
		//In order to ensure that we have game date it returns the data for the previous polling period
		$timestamp = $timestamp - $timestamp % 60;
		if ($timestamp > time() - Config::get('lanager/steam.pollingInterval')) {
			$timestamp = $timestamp - Config::get('lanager/steam.pollingInterval');
			$timestamp = $timestamp - $timestamp % 60;
		}
		$applications= [];
		if (Cache::has('applicationUsage'.$timestamp)) {
			$applications =  Cache::get('applicationUsage'.$timestamp);
		} else {
			$states = $this->states->at( $timestamp )->whereNotNull('states.application_id')->get();
	
			if ( count($states) )
			{
				// Collect and combine states for the same application
				foreach($states as $state)
				{
					// merge states that refer to the same application 
					$combinedUsage[$state->application_id]['application'] = $this->applicationTransformer->transform( $state->application );
				
					// add the state's user as a child of the above application key
					$combinedUsage[$state->application_id]['users'][] = $this->userTransformer->transform( $state->user );
				}
	
				// Build clean array of applications
				foreach($combinedUsage as $usageItem)
				{
					$usageItem['application']['users'] = $usageItem['users'];
					$applications[] = $usageItem['application'];
				}
	
				// Sort applications array by user count, in decending order
				usort($applications, function($a, $b) {
					return count($b['users']) - count($a['users']);
				});
	
			}
			Cache::add('applicationUsage'.$timestamp,$applications,1);
		}
		return $applications;
	}

}
