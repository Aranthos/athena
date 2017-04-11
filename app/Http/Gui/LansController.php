<?php namespace Zeropingheroes\Lanager\Http\Gui;

use Zeropingheroes\Lanager\Domain\Lans\LanService;
use Zeropingheroes\Lanager\Domain\Achievements\AchievementService;
use View;
use Redirect;

class LansController extends ResourceServiceController {

	/**
	 * Set the controller's service
	 */
	public function __construct()
	{
		$this->service = new LanService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$lans = $this->service->all();

		return View::make( 'lans.index' )
					->with( 'title', 'LANs' )
					->with( 'lans', $lans );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$a_service = new AchievementService;
		$achievements = ['' => ''] + lists( $a_service->all(), 'id', 'name' );
		return View::make( 'lans.create' )
					->with( 'title', 'Create LAN' )
					->with( 'lan', null )
					->with( 'achievements', $achievements);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show( $id )
	{
		$lan = $this->service->single( $id );

		return View::make( 'lans.show' )
					->with( 'title', $lan->name )
					->with( 'lan', $lan );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$lan = $this->service->single( $id );
		$a_service = new AchievementService;
		$achievements = ['' => ''] + lists( $a_service->all(), 'id', 'name' );

		return View::make( 'lans.edit' )
					->with( 'title', 'Edit LAN' )
					->with( 'lan', $lan )
					->with( 'achievements', $achievements);
	}

	protected function redirectAfterStore( $resource )
	{
		return Redirect::route( 'lans.show', $resource['id'] );
	}

	protected function redirectAfterUpdate( $resource )
	{
		return $this->redirectAfterStore( $resource );
	}

	protected function redirectAfterDestroy( $resource )
	{
		return Redirect::route( 'lans.index' );
	}

}
