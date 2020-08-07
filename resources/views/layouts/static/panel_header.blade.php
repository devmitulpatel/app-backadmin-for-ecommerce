<nav class="navbar navbar-expand-md navbar-light shadow-sm header">
    <div class="container-fluid">
    <!--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
-->

        @auth

            <div  class="btn btn-outline-info" style="z-index: 2;" v-on:click="toggleSidebar()">
                    <span    >
                        <i class="fas fa-bars" style="display: inline-block;padding-right:10px"></i>
                        <span style="display: inline-block">Menu</span>
                        </span>
            </div>

        @endauth

        <div   style="width: 98%;position: absolute;z-index: 1;" class="d-flex justify-content-center" >

            <div>
                <img  id="headerlogo" :class="{ 'headerlogo-small':winDown}"  src="{{ settings()->get('websiteLogo') }}">
            </div>



        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="z-index: 1;">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @auth
                <li class="nav-item p-2 darkmode-btn">
                    <div class="custom-control custom-switch" >
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" v-model="darkMode">
                        <label class="custom-control-label" for="customSwitch1">Dark @{{ (darkMode)?'on':'off' }}</label>
                    </div>
                </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
