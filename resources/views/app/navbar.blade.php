<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}" style="margin-right: 8px">Aksata</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li>
                        <a href="{{ url('/auth/login') }}">Login</a>
                    </li>
                @else
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->nim }} | {{ Auth::user()->profile->nama_lengkap }} <span class="caret"></span>
                        </a>
                        <ul id="g-account-menu" class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/profile') }}"><i class="fa fa-user"></i> My Profile</a>
                            </li>
                            <li>
                                <a href="{{ url('/settings') }}"><i class="fa fa-cog"></i> Account Settings</a>
                            </li>
                            <li>
                                <a href="{{ url('/auth/logout') }}"><i class="fa fa-lock"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>

            @include('search.form', ['navbar' => true])
        </div>
    </div>
</div>
