<?php namespace Zeropingheroes\Lanager;

use Zeropingheroes\Lanager\Shouts\Shout,
	Zeropingheroes\Lanager\Shouts\ShoutValidator;
use Input, Redirect, View, Auth, Notification;

class ShoutsController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('permission', ['only' => ['store', 'update', 'destroy'] ]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$shouts = Shout::with('user', 'user.roles')
					->orderBy('pinned', 'desc')
					->orderBy('created_at', 'desc')
					->paginate(10);

		return View::make('shouts.index')
					->with('title', 'Shouts')
					->with('shouts', $shouts);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$shout = new Shout;
		$shout->user_id = Auth::user()->id;

		$shout->fill( Input::get() );

		$shoutValidator = ShoutValidator::make( $shout->toArray() )->scope('store');

		if ( $shoutValidator->fails() )
		{
			Notification::danger( $shoutValidator->errors()->all() );
			return Redirect::back()->withInput();
		}

		$shout->save();
		Notification::success('Shout successfully stored');
		return Redirect::back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$shout = Shout::findOrFail($id);
		$shout->fill( Input::get() );

		$shoutValidator = ShoutValidator::make( $shout->toArray() )->scope('update');

		if ( $shoutValidator->fails() )
		{
			Notification::danger( $shoutValidator->errors()->all() );
			return Redirect::back()->withInput();
		}

		$shout->save();
		Notification::success('Shout successfully updated');
		return Redirect::back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$shout = Shout::findOrFail($id);

		$shout->delete();
		Notification::success('Shout successfully destroyed');
		return Redirect::back();
	}

}