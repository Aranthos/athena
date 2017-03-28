<ul class="nav navbar-nav navbar-right">
	@if (Auth::check())
		@include('layouts.default.admin')
		<li class="dropdown">
			<a href="#" class="dropdown-toggle navbar-user" data-toggle="dropdown" title="{{{ Auth::user()->username }}}">
				@include('users.partials.avatar', ['user' => Auth::user()] )
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
				<li><a href="{{ route('users.show', 'me' ) }}">{{ Icon::user() }} Profile</a></li>
				@if (Config::Get('lanager/nav.showApi',false))
				<li><a href="{{ route('users.show', ['id' => 'me', 'tab' => 'api']) }}">{{ Icon::transfer() }} API</a></li>
				@endif
				<li><a href="{{ route('sessions.destroy') }}">{{ Icon::logOut() }} Log Out</a></li>
			</ul>
		</li>
	@else
		<li>
			<a href="{{ URL::route('sessions.create') }}" class="navbar-signin"><img src="{{ asset('/img/sits_small.png') }}" width="154" height="23"></a>
		</li>
	@endif
</ul>
