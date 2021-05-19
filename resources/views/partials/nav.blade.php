<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('https://proficientessays.com') }}">
            <img src="{{ asset('images/Prof-E_logo.png') }}" width="120px" height="60px" class="img-responsive">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{-- Left Side Of Navbar --}}
            <ul class="navbar-nav mr-auto">
                @role('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <button class="btn btn-primary btn-small"> {!! trans('Admin Directories') !!}</button>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                           <!--
                            <a class="dropdown-item {{ (Request::is('roles') || Request::is('permissions')) ? 'active' : null }}" href="{{ route('laravelroles::roles.index') }}">
                                {!! trans('titles.laravelroles') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('users', 'users/' . Auth::user()->id, 'users/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/users') }}">
                                {!! trans('titles.adminUserList') !!}
                            </a>
                             <div class="dropdown-divider"></div>

                         -->                             

                           <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/home') }}">
                                   Dashboard
                           </a>
                             <hr>




                            <a class="dropdown-item {{ Request::is('operations', 'operations/' . Auth::user()->id, 'operations/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/operations') }}">
                                {!! trans('New Orders') !!}
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('Viewed_Orders', 'Viewed_Orders/' . Auth::user()->id, 'Viewed_Orders/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/Viewed_Orders') }}">
                                {!! trans('Viewed Orders') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('Rejected_Orders', 'Rejected_Orders/' . Auth::user()->id, 'Rejected_Orders/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/rejectedOrders') }}">
                                {!! trans('Your Rejected Orders') !!}
                            </a>

                              <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('Replied_Orders', 'Replied_Orders/' . Auth::user()->id, 'Replied_Orders/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/Replied_Orders') }}">
                                {!! trans('Replied Orders') !!}
                            </a>
                            


                              <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('Replied_Orders', 'Replied_Orders/' . Auth::user()->id, 'Replied_Orders/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/submited_Orders') }}">
                                {!! trans('Submited Ready Orders') !!}
                            </a>



                              <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('orders_for_Revision', 'orders_for_Revision/' . Auth::user()->id, 'orders_for_Revision/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('/orders_for_Revision') }}">
                                {!! trans('Orders To be Revised') !!}
                            </a>

                             <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('Replied_Orders', 'Replied_Orders/' . Auth::user()->id, 'Replied_Orders/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('https://proficientessays.com') }}">
                                {!! trans('Back to website') !!}
                            </a>

                            <!--

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('users/create') ? 'active' : null }}" href="{{ url('/users/create') }}">
                                {!! trans('titles.adminNewUser') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('themes','themes/create') ? 'active' : null }}" href="{{ url('/themes') }}">
                                {!! trans('titles.adminThemesList') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('logs') ? 'active' : null }}" href="{{ url('/logs') }}">
                                {!! trans('titles.adminLogs') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/activity') }}">
                                {!! trans('titles.adminActivity') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('phpinfo') ? 'active' : null }}" href="{{ url('/phpinfo') }}">
                                {!! trans('titles.adminPHP') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('routes') ? 'active' : null }}" href="{{ url('/routes') }}">
                                {!! trans('titles.adminRoutes') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('active-users') ? 'active' : null }}" href="{{ url('/active-users') }}">
                                {!! trans('titles.activeUsers') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('blocker') ? 'active' : null }}" href="{{ route('laravelblocker::blocker.index') }}">
                                {!! trans('titles.laravelBlocker') !!}
                            </a>
                        -->
                        </div>
                    </li>
                @endrole
                  @role('user')
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <button class="btn btn-info btn-small"> {!! trans('User Directories') !!}</button>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            
                             <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/home') }}">
                                   Dashboard
                                </a>
                             <hr>
                           
                                <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/makeOrder') }}">
                                    Order Now
                                </a>
                             
                             <div class="dropdown-divider"></div>
                                <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/active_orders') }}">
                                    Active Orders
                                </a>
                             <div class="dropdown-divider"></div>
                                <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/in_Progress') }}">
                                    In Progress
                                </a>

                            <div class="dropdown-divider"></div>
                                 <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/rejected_orders') }}">
                                   
                                     {!! trans(' Rejected Orders') !!}
                                </a>

                            <div class="dropdown-divider"></div>
                                 <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/replied_orders') }}">
                                   
                                     {!! trans(' Replied Orders') !!}
                                </a>

                            <div class="dropdown-divider"></div>
                                 <a class="dropdown-item {{ Request::is('activity') ? 'active' : null }}" href="{{ url('/downloads') }}">
                                   
                                     {!! trans('Your Ready Papers') !!}
                                </a>
                             <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ Request::is('Replied_Orders', 'Replied_Orders/' . Auth::user()->id, 'Replied_Orders/' . Auth::user()->id . '/edit') ? 'active' : null }}" href="{{ url('https://proficientessays.com') }}">
                                {!! trans('Back to website') !!}
                            </a>

                            
                           
                           
                        </div>
                    </li>
                @endrole
            </ul>
            {{-- Right Side Of Navbar --}}
            <ul class="navbar-nav ml-auto">
                {{-- Authentication Links --}}
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ trans('titles.login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ trans('titles.register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                            @else
                                <div class="user-avatar-nav"></div>
                            @endif
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}" href="{{ url('/profile/'.Auth::user()->name) }}">
                                {!! trans('titles.profile') !!}
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
