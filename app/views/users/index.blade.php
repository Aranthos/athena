@extends('layouts.default')
@section('content')
	@include('layouts.default.title')
	@include('layouts.default.alerts')

	@if (count($users))
		<table class="table users-index">
			<thead>
				<tr>
					<th>User</th>
					<th>Status</th>
					<th>Currently Playing</th>
					<th>Achievements</th>
					@if ( Authority::can('delete', 'users') OR Authority::can('manage', 'user-roles') )
						<th class="text-center">{{ Icon::cog() }}</th>
					@endif
				</tr>
			</thead>
			<tbody>
			@foreach( $users as $user )
				@if ($user->visible)
				<?php $state = $user->state; ?>
				<tr>
					<td>
						@include('users.partials.avatar-username', ['user' => $user])
						@include('roles.partials.badges', ['roles' => $user->roles])
					</td>
					<td>
						@if ( $state )
							@include('users.partials.status-label', ['state' => $state])
						@endif
					</td>
					<td>
						@if ( isset($state->application) )
							@include('applications.partials.link', ['application' => $state->application])
						@endif
					</td>
					<td>
						@include('plural', ['singular' => 'achievement', 'collection' => $user->userAchievements] )
						@include('user-achievements.partials.ribbon', ['userAchievements' => $user->userAchievements()->orderBy('lan_id','desc')->orderBy('created_at','desc')->get()->take(6), 'size'=>'small'])
					</td>
					@if ( Authority::can('delete', 'users') OR Authority::can('manage', 'user-roles') )
						<td class="text-center">
							@include('buttons.create',
								[
									'resource' => 'user-roles',
									'parameters' =>
										[
											'user_id' => $user->id
										],
									'size' => 'extraSmall',
									'icon' => 'user',
									'hover' => 'Assign a role to this user',
								])
							@include('buttons.destroy', ['resource' => 'users', 'item' => $user, 'size' => 'extraSmall'])
						</td>
					@endif
				</tr>
				@endif
			@endforeach
			</tbody>
		</table>
	@else
		<p>No users found!</p>
	@endif

@endsection
