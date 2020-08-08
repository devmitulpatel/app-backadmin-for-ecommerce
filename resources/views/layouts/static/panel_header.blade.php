<nav class="navbar navbar-expand-md navbar-light shadow-sm  sticky-top">



        <li class="container-fluid">
        <!--            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
-->

            @auth

                <button  type="button"  class="btn" style="z-index: 2;border-color: rgba(0, 0, 0, 0.1);" v-on:click="toggleSidebar()">

                    <span class="navbar-toggler-icon" style="display: inline-block"></span>

                </button>


                <div   style="z-index: 1;" class="d-flex justify-content-center" >

                    <div>
                        <img  id="headerlogo" :class="{ 'headerlogo-small':winDown}"  src="{{ settings()->get('websiteLogo') }}">
                    </div>




                </div>




            @endauth
            <button class="navbar-toggler" type="button" style="z-index:5;" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent" style="z-index: 1;">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @auth
                        <li class="nav-item"   >
                            <div class="natoication-drawer" :class="{'slideDown':notificationDrawer,'slideUp':!notificationDrawer}">


                                <ul class="list-group" style="border-radius: 0px"  @mouseleave="autoHideNotification()">
                                    <li class="list-group-item list-group-item-action" v-for="noti in notificationAll">@{{noti.title}}


                                        <div class="btn-group float-right " role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-outline-danger"  v-if="noti.hasOwnProperty('actions')&&noti.actions.hasOwnProperty('delete')"> <i class="far fa-trash-alt"></i></button>
                                            <button type="button" class="btn btn-outline-info" v-if="noti.hasOwnProperty('actions')&&noti.actions.hasOwnProperty('goto')"> <i class="far fa-arrow-alt-circle-right"></i></button>
                                        </div>

                                     <small class="text-muted"><br>@{{noti.description}}</small> </li>


                                </ul>

                            </div>
                        </li>
                        <li class="nav-item p-2 px-3 mr-2 btn dropdown"
                            :class="{
                    'btn-outline-info':!newNotification,
                    'btn-info':newNotification


                    }" v-on:click="toggleNotification"
                        >

                            <i :class="{
                    'far fa-bell shadow':!newNotification,
                    'fas fa-bell animate__animated animate__swing animate__infinite infinite':newNotification

                        }"></i>





                        </li>


                        <li class="nav-item p-2 btn darkmode-btn">
                            <div class="custom-control custom-switch" >
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" v-model="darkMode">
                                <label class="custom-control-label" for="customSwitch1" v-if="darkMode">Dark on</label>
                                <label class="custom-control-label" for="customSwitch1" v-if="!darkMode">Dark off</label>
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
                        <li class="nav-item dropdown ">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle btn"  style="border-color: rgba(0, 0, 0, 0.1);" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

        </li>

</nav>
