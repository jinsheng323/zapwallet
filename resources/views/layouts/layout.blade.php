<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">

    <link rel="icon" type="image/png" href="img/favicon.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <link href="{{ env('APP_URL') }}/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ env('APP_URL') }}/css/material-kit.css" rel="stylesheet"/>

	<link href="{{ env('APP_URL') }}/css/demo.css" rel="stylesheet" />
	<link href="{{ env('APP_URL') }}/css/style.css" rel="stylesheet" />
    <script src="{{ env('APP_URL') }}/js/jquery.min.js" type="text/javascript"></script>
    <script src="{{ env('APP_URL') }}/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ env('APP_URL') }}/js/material.min.js"></script>

    {{-- <script src="{{ env('APP_URL') }}js/login-register.js" type="text/javascript"></script> --}}
    <!-- Styles -->
</head>
<body  class="index-page">
	<nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-index">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="/">
					<div class="logo-container">
						<div class="logo">
							<img src="{{ env('APP_URL') }}/img/logo.png">
						</div>
						<div class="brand">
							Zap Wallet
						</div>


					</div>
				</a>
			</div>

			<div class="collapse navbar-collapse" id="navigation-index">
				<ul class="nav navbar-nav navbar-right">
					<li>
                    @guest
						<a data-toggle="modal" href="javascript:void(0)" onclick="javascript:openLoginModalFrm();">
							<i class="material-icons">account_circle</i>Login
						</a>
                    @endguest
					</li>
					<li>
                        @guest
                        @else
						<div class="dropdown">
							<a href="#" class="btn btn-simple dropdown-toggle" data-toggle="dropdown" style="color: #fff; margin-top: 5px;">
								<i class="material-icons" style="font-size: 20px;">account_circle</i>
								Welcome {{ Auth::user()->name }}
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
                                <li><a href="profile">View Profile</a></li>
                                @if(Auth::user()->role=='admin')
								<li><a href="{{ route('admin') }}">Admin</a></li>

                                @endif
								<li><a href="{{ route('transaction') }}">Previous Orders</a></li>
								<li class="divider"></li>
								<li>
									<a href="#">
										Zap Wallet: &#x20b9; 
										@if(isset($walletBallance))
											{{ $walletBallance }}
										@else
											0
										@endif
									</a>
								</li>
								<li class="divider"></li>
								<li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                 </a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                </li>
							</ul>
                        </div>
                        @endguest
					</li>



				</ul>
			</div>
		</div>
    </nav>


    @if(session('success'))
		<div class="container" style="position: fixed; right: 0; bottom: 0; z-index: 9999;">
			<div class="alert alert-success" style="width: 50%; float: right;">
				<div class="container-fluid">
					<div class="alert-icon">
						<i class="material-icons">check</i>
					</div>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="material-icons">clear</i></span>
					</button>
					<b>{{ session('success') }}</b><!--  You have recharged successfully! -->
				</div>
			</div>
		</div>
    @endif
    @if(session('fail'))
		<div class="container" style="position: fixed; right: 0; bottom: 0; z-index: 9999;">
			<div class="alert alert-danger" style="width: 50%; float: right;">
				<div class="container-fluid">
					<div class="alert-icon">
						<i class="material-icons">check</i>
					</div>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true"><i class="material-icons">clear</i></span>
					</button>
					<b>{{ session('fail') }}</b><!--  You have recharged successfully! -->
				</div>
			</div>
		</div>
    @endif
	
	
	@if(!isset(Auth::user()->id))
	<div class="modal fade login" id="loginModal">
		<div class="modal-dialog login animated">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Login with</h4>
				</div>
				<div class="modal-body">
					<div class="box">
						<div class="content">
							{{-- <div class="social"> --}}

								{{-- <a id="google_login" class="circle linkedin linkin" href="linkedin2oauth/process.php"><i class="fa fa-linkedin fa-fw"></i>Sign in with Linkedin</a>
								<a class="goog circle google" href="https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri=https%3A%2F%2Ftellifone.com%2Fgoogle2oauth&client_id=1075164089585-ptsp31m2mqlomn8n49logh3jd6aiklui.apps.googleusercontent.com&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&access_type=offline&approval_prompt=force">
									<i class="fa fa-google-plus fa-fw">
									</i>Sign in with Google</a> --}}

								{{-- <a id='facebook_login' class="fb circle facebook" href="facebook2oauth/index.php"><i class="fa fa-facebook fa-fw"></i>Sign in with Facebook</a> --}}
							{{-- </div> --}}
							{{-- <div class="division">
								<div class="line l"></div>
								<span>or</span>
								<div class="line r"></div>
							</div> --}}
							<div class="error"></div>
							<div class="form loginBox">

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <input id="email"  placeholder="Email"  type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
												@if ($message=='These credentials do not match our records.')
													<script>
														$('#loginModal').modal('show');
													</script>
													
												
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
												@endif
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <input id="password" placeholder="Password"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-default btn-login">
                                                {{ __('Login') }}
                                            </button>

                                            @if (Route::has('password.request'))
                                                <br>
                                                <?php /*<a class="" href="{{ route('password.request') }}">*/?>
												<a class="" id="forgot_btn"  href="javascript: showForgotPasswordForm();">
                                                    {{ __('Forgot Your Password?') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </form>

							</div>
						</div>
					</div>
					<div class="box">
						<div class="content registerBox" style="display:none;">
							<div class="form">

                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group row">


                                        <div class="col-md-12">
                                            <input id="name" placeholder="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <input id="email2" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                            @if ($message=='The email has already been taken.')
                                            <script>
                                                $('#loginModal').modal('show');
                                                showRegisterForm();
                                            </script>
                                            
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
												@endif
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <input id="phone" placeholder="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">


                                        <div class="col-md-12">
                                            <input id="password"  placeholder="Password " type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            <div class="text-danger"><small>Minimum 8 characters, One capital letter, One special character, One number</small></div>

                                            @error('password')

                                            <script>
                                                $('#loginModal').modal('show');
                                                showRegisterForm();
                                            </script>

                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <input id="password-confirm" placeholder="Repeat Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-default btn-register">
                                                Create account
                                            </button>


                                        </div>
                                    </div>
                                </form>
							</div>
						</div>
					</div>
					
					<?php /*  08-06-2020 : Start */ ?>
					<div class="box">
						<div class="content resetPasswordBox" style="display:none;">
							<div class="form">
								@if (session('status'))
									<div class="alert alert-success" role="alert">
										{{ session('status') }}
										<script>
										$().ready(function(){
											$('#loginModal').modal('show');
											showForgotPasswordForm();
										});
										</script>										
									</div>
								@else								
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="form-group row">

                                        <div class="col-md-12">
                                            <input id="email3" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

											@error('email')
												@if($message == "We can't find a user with that email address.")
												
												
												<script>
												$().ready(function(){
													$('#loginModal').modal('show');
													showForgotPasswordForm();
												});
												</script>
												
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@endif
											@enderror
                                        </div>
                                    </div>
                                    

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-default btn-forgotpassword">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
								
								@endif
							</div>
						</div>
					</div>					
					<?php /*  08-06-2020 : End */ ?>
					<?php /*  09-06-2020 : Start */ ?>
					<div class="box">
						<div class="content resetPasswordFrmBox" style="display:none;">
							<div class="form">
								@if (isset($passwordreset_token))
									<script>
										$().ready(function(){										
											$('#loginModal').modal('show');
											passwordResetForm();
										});
									</script>
									<form method="POST" action="{{ route('password.update') }}">
										@csrf

										<input type="hidden" name="token" value="{{ $passwordreset_token }}">

										<div class="form-group row">
											<div class="col-md-12">
												<input id="email" type="email" readonly class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" >

												@error('email')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-12">
												<input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autofocus autocomplete="new-password">
												
												@error('password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
												<div class="text-danger"><small>Minimum 8 characters, One capital letter, One special character, One number</small></div>
											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-12">
												<input id="password-confirm"  placeholder="{{ __('Confirm Password') }}" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
											</div>
										</div>

										<div class="form-group row mb-0">
											<div class="col-md-12">
												<button type="submit" class="btn btn-default btn-login">
													{{ __('Reset Password') }}
												</button>
											</div>
										</div>
										
										
									</form>								
								@endif
							</div>
						</div>
					</div>					
					<?php /*  09-06-2020 : End */ ?>
					
					
					
					
					
					
				</div>
				<div class="modal-footer">
					@if(!isset(Auth::user()->id))
					
					<div class="forgot login-footer">
						<span>Looking to
							<a href="javascript: showRegisterForm();">create an account</a>
							?</span>
					</div>
					<div class="forgot register-footer" style="display:none">
						<span>Already have an account?</span>
						<a href="javascript: showLoginForm();">Login</a>
					</div>
					
					@endif
				</div>
			</div>
		</div>
	</div>
	@endif



        @yield('content')


        <footer class="k-footer">
            <div>
                <div class="container">
                    <div class="col-lg-3 col-sm-12 col-md-3">
                        <h1>Mobile Recharges</h1>
                        <ul>
                            <li><a href="#">Airtel</a></li>
                            <li><a href="#">Aircel</a></li>
                            <li><a href="#">BSNL</a></li>
                            <li><a href="#">Idea</a></li>
                            <li><a href="#">MTNL</a></li>
                            <li><a href="#">MTS</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-12 col-md-3">
                        <h1>DTH Recharges</h1>
                        <ul>
                            <li><a href="#">Airtel Digital</a></li>
                            <li><a href="#">Dish TV</a></li>
                            <li><a href="#">Tata Sky</a></li>
                            <li><a href="#">Reliance Digital</a></li>
                            <li><a href="#">Sun Direct</a></li>
                            <li><a href="#">Videocon D2H</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-12 col-md-3">
                        <h1>Datacard Recharges</h1>
                        <ul>
                            <li><a href="#">Airtel 2G</a></li>
                            <li><a href="#">Aircel 2G</a></li>
                            <li><a href="#">BSNL 2G</a></li>
                            <li><a href="#">MTS MBlaze</a></li>
                            <li><a href="#">Tata Photon Plus</a></li>
                            <li><a href="#">Reliance NetConnect</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-sm-12 col-md-3">
                        <h1>Payment Options</h1>
                        <ul>
                            <li><a href="#">Credit Cards</a></li>
                            <li><a href="#">Debit Cards</a></li>
                            <li><a href="#">Any Visa Debit Card (VBV)</a></li>
                            <li><a href="#">Direct Bank Debits</a></li>
                            <li><a href="#">Cashbacks</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6 col-lg-offset-3">
                        <h2><i class="fa fa-cogs"></i> Web Design by <a href="https://www.pencilbuddha.com" style="color: #444;">Pencil Buddha</a> | A <a href="http://zcroz.com" style="color: #444;">Zcroz Company</a></h2>
                    </div>
                </div>
            </div>
        </footer>





    <script src="{{ env('APP_URL') }}/js/nouislider.min.js" type="text/javascript"></script>
	{{-- <script src="{{ env('APP_URL') }}/js/bootstrap-datepicker.js" type="text/javascript"></script> --}}
	<script src="{{ env('APP_URL') }}/js/material-kit.js" type="text/javascript"></script>
    <script type="text/javascript">
		$().ready(function(){
			// the body of this function is in assets/material-kit.js
			// materialKit.initSliders();
            window_width = $(window).width();

            if (window_width >= 992){
                big_image = $('.wrapper > .header');

				$(window).on('scroll', materialKitDemo.checkScrollForParallax);
			}

		});
	</script>
	<script type="text/javascript">

		function openLoginModalFrm(){
		    showLoginForm();
			setTimeout(function(){
				$('#loginModal').modal('show');    
			}, 230);
		}

	
        $("input[value='radio-1']").click(function() {
            $('.radio-default span').text('Prepaid');
            if(this.checked){
            $('.btn-lg').text('Recharge Now');
            }
            if(this.unchecked){
                $('.btn-lg').next().text('Complete Payment');
            }
        });
        $("input[value='radio-2']").click(function() {
            $('.radio-default span').text('Postpaid');
            if(this.checked){
            $('.btn-lg').text('Pay Bill');
            }
        });
        $('.btn-login').on('click',function(){
			var email=$('#email').val();
            var password=$('#password').val();
            console.log(password);
            // Remove this comments when moving to server
            $.post("login.php",{email:email, password: password}, function(data)
            {
				if(data == '1'){
					location.reload('true');
					// window.location.replace("/home");
				} else {
					shakeModal();
				}
            });
        });
		
		
		
        </script>
		<script>
		

		
		
passwordResetForm = function(){
	$('.loginBox').fadeOut('fast',function(){
		
		$('.resetPasswordFrmBox').fadeIn('fast');
		$('.login-footer').fadeOut('fast',function(){
			$('.register-footer').fadeIn('fast');
		});
		$('.modal-title').html('Reset Password');
	}); 
	$('.error').removeClass('alert alert-danger').html('');			
}
		
showForgotPasswordForm = function(){
	$('.loginBox').fadeOut('fast',function(){
		
		$('.resetPasswordBox').fadeIn('fast');
		$('.login-footer').fadeOut('fast',function(){
			$('.register-footer').fadeIn('fast');
		});
		$('.modal-title').html('Reset Password');
	}); 
	$('.error').removeClass('alert alert-danger').html('');			
}
 
/*function showLoginFrm(){
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login with');
    });       
     $('.error').removeClass('alert alert-danger').html(''); 
}*/
 
 
function showRegisterForm(){
    $('.loginBox').fadeOut('fast',function(){
        $('.registerBox').fadeIn('fast');
        $('.login-footer').fadeOut('fast',function(){
            $('.register-footer').fadeIn('fast');
        });
        $('.modal-title').html('Register with');
    }); 
    $('.error').removeClass('alert alert-danger').html('');
       
}
function showLoginForm(){
	
	$('#loginModal .resetPasswordFrmBox').fadeOut('fast',function(){}); 
	$('#loginModal .resetPasswordBox').fadeOut('fast',function(){}); 
	
    $('#loginModal .registerBox').fadeOut('fast',function(){
        $('.loginBox').fadeIn('fast');
        $('.register-footer').fadeOut('fast',function(){
            $('.login-footer').fadeIn('fast');    
        });
        
        $('.modal-title').html('Login with');
    });       
    $('.error').removeClass('alert alert-danger').html(''); 
}


function openLoginModal(){
    showLoginForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}


function openRegisterModal(){
    showRegisterForm();
    setTimeout(function(){
        $('#loginModal').modal('show');    
    }, 230);
    
}




function loginAjax()
{
    // var name=$('#name').val();
    var email=$('#email').val();
    var password=$('#password').val();
    alert('password');
       // Remove this comments when moving to server
    $.post("login.php",{email:email, password: password}, function(data)
     {
            if(data == 1){
                // window.location.replace("/home");            
            } else {
                 shakeModal(); 
            }
    });
    

/*   Simulate error message from the server   */
     // shakeModal();
}

function shakeModal(){
    $('#loginModal .modal-dialog').addClass('shake');
             $('.error').addClass('alert alert-danger').html("Invalid email/password combination");
             $('input[type="password"]').val('');
             setTimeout( function(){ 
                $('#loginModal .modal-dialog').removeClass('shake'); 
    }, 1000 ); 
}

function changepaginate(){
	var id = $('#paginate').val();
	//alert(id);
	window.location.href = "/order-history?paginate="+id;
}   		

function defaultTab(){
	$('#select_seat').show();
	$('#defaultOpen').click();
}

function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

seatbook = function (){
	var seatId = arguments[0];
	$('#lseat'+seatId).css({'background-color':'#1db24b'});
}
	
useatbook = function (){
	var seatId = arguments[0];
	$('#useat'+seatId).css({'background-color':'#1db24b'});
}		
		</script>
		
		
		
		
		
</body>
</html>
