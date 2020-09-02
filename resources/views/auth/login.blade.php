@extends('layouts.app-boilerplate')

@section('content')

    <div>



        <div class="limiter">
            <div class="container-login100" >
                <div class="wrap-login100 p-l-15 p-r-15 p-t-10 p-b-15 ">
                    <form v-on:submit.prevent="loginFormEvent('{{ route('api.login',['type'=>'web']) }}')" class="login100-form validate-form flex-sb flex-w" method="post"  action="{{ route('login') }}">
                        @csrf
					<span class="login100-form-title p-b-7">
                    <div style="width: 100%;max-height: 120px;">
                        <img id="sidebarlogo"  src="{{ settings()->get('websiteLogo') }}" style="max-height: 100px;" >
                    </div>

						{{ __('Login') }}


					</span>




                        <div class="form-group input-group p-t-13 p-b-1" >
                            <label class="has-float-label" style="width: 100%;" >
                                <input v-model="currentUser.email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" placeholder=" "  style="width: 100%;"  />
                                <span class="txt1">{{ __('E-Mail Address') }}</span>
                            </label>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group input-group p-t-1 p-b-2" >
                            <label class="has-float-label" style="width: 100%;" >
                                <input v-model="currentUser.password" class="form-control" type="password" name="password" placeholder="   "  value="{{ old('password') }}" style="width: 100%;" />
                                <span class="txt1">{{ __('Password') }} </span>
                            </label>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="container-login100-form-btn m-t-10 m-b-1">
                            <button class="login100-form-btn">
                                Sign In
                            </button>
                        </div>

                        <div class="p-t-13 p-b-9 text-center" style="width: 100%;">
                           	<span class="txt1 text-center">
							or

						</span>
                            <br>
                            <span class="txt1 text-center">
							use your social account
						</span>
                        </div>

                        <a href="#" class="btn-face m-b-20">
                            <i class="fab fa-facebook-square"></i>
                            Facebook
                        </a>

                        <a href="#" class="btn-google m-b-20" style="background-color: rgba(222, 73, 51, 1);color: rgba(255,255,255,1);">
                            <i class="fab fa-google " style="font-size: 30px;margin-right: 17px;"></i>
                            Google
                        </a>


                        <div class="w-full text-center p-t-20">
						<span class="txt2" target="_blank">
							Not a member?
						</span>

                            <a  href="{{route('password.request')}}" class="txt2 bo1">
                                Sign up now
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div id="dropDownSelect1"></div>



    </div>

<div class="container hidden" style="min-height: 100vh" v-if="false">
    <div class="row justify-content-center align-middle" style="min-height: 100vh">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
