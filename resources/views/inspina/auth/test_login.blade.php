<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">

		<title>Tidy Login</title>

		<link rel="stylesheet" href="{{asset('login/css/lib/bootstrap.min.css') }}"  webstripperwas="/css/lib/bootstrap.min.css" >
		<link rel="stylesheet" href="{{asset('/login/netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css') }}"  webstripperwas="http://netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.min.css" >
		<link href="{{asset('/login/fonts.googleapis.com/css.6.css') }}"  webstripperwas='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
		<!-- <link rel="stylesheet" href="{{asset('/login/css/lib/bootstrap-responsive.min.css') }}"> -->
		<link rel="stylesheet" href="{{asset('/login/css/main.css') }}"  webstripperwas="/css/main.css" >
	</head>

	<body>
		<div id="fb-root"></div>


		<div class="apollo">
			<div class="apollo-container clearfix">
				<div class="apollo-facebook">
					<div class="apollo-image"></div>
				</div>

				<div class="apollo-register">
					<form class="form-signin" id="apollo-register-form">
						<div class="form-group">
							<input type="text" value="" id="registerEmail" class="form-control email" placeholder="Email address"/>
						</div>

						<div class="form-group">
							<input type="password" value="" class="form-control" placeholder="Password"/>
						</div>

						<div class="form-group">
							<input type="password" value="" class="form-control" placeholder="Confirm password"/>
						</div>


						<p class="apollo-seperator"> about you </p>

						<div class="form-group">
							<input type="text" value="" class="form-control" id="firstName" placeholder="First name"/>
						</div>

						<div class="form-group">
							<input type="text" value="" class="form-control" id="lastName" placeholder="Last name"/>
						</div>

						
						<button class="btn btn-lg btn-block btn-primary" type="submit">Register</button>
					</form>

					<p class="apollo-back"> <a href="#"><i class="icon-arrow-left"></i> back to login</a> </p>
				</div>

				<div class="apollo-login">
					<button class="btn btn-block btn-facebook btn-lg">Connect with <strong>Facebook</strong></button>

					<p class="apollo-seperator"> or </p>

					<form class="form-signin" id="apollo-login-form">
						<div class="form-group">
							<input type="text" value="" id="email" class="form-control email" placeholder="Email address"/>
						</div>

						<div class="form-group">
							<input type="password" value="" class="form-control" placeholder="Password"/>
						</div>

						<button class="btn btn-lg btn-signin btn-block" type="submit">Sign in</button>
					</form>

					<p class="apollo-register-account"> <a href="#" class="register-link">Need an account? <strong>Register here </strong><i class="icon-arrow-right"></i></a><br/><a href="#" class="password-link"><small>Forgot your password?</small></a> </p>
					<p class="apollo-change-account"> <a href="#"><i class="icon-arrow-left"></i><strong>Not you?</strong> Sign in as a different user</a> </p>
				</div>

				<div class="apollo-forgotten-password">
					<form class="form-signin" id="apollo-forgotten-password-form">
						<div class="form-group">
							<input type="text" value="" class="form-control email" placeholder="Email address"/>
						</div>
						<button class="btn btn-lg btn-block btn-primary" type="submit">Reset password</button>
					</form>

					<p class="apollo-back"> <a href="#"><i class="icon-arrow-left"></i> back to login</a> </p>
				</div>

				<div class="apollo-logging-in">
					<h2>Welcome back<span class="user-name"></span>!</h2>
					<p><strong>Please wait whilst we securely log you in&hellip;</strong></p>

					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus dignissim enim suscipit massa ornare rutrum.</p>
				</div>

				<div class="apollo-registering">
					<h2>Thanks<span class="user-name"></span>!</h2>
					<p><strong>We've sent you an activation email, blah blah...</strong></p>
					<p>Nullam ac erat nunc. Donec in orci purus, vel tempor tortor. Integer tincidunt ipsum sed ipsum scelerisque malesuada.</p>
				</div>

				<div class="apollo-password-reset">
					<h2>Check your email</h2>
					<p><strong>We've sent you a link, blah blah...</strong></p>
					<p>Nullam ac erat nunc. Donec in orci purus, vel tempor tortor. Integer tincidunt ipsum sed ipsum scelerisque malesuada.</p>
				</div>
			</div>
		</div>

		<script src="{{asset('/login/js/lib/jquery.min.js')}}"  webstripperwas="/js/lib/jquery.min.js" ></script>
		<script src="{{asset('/login/js/lib/images.js')}}"  webstripperwas="/js/lib/images.js" ></script>
		<script src="{{asset('/login/js/lib/md5.js')}}"  webstripperwas="/js/lib/md5.js" ></script>
		<script src="{{asset('/login/js/lib/bootstrap.min.js')}}"  webstripperwas="/js/lib/bootstrap.min.js" ></script>
		<script src="{{asset('/login/js/main.js')}}"  webstripperwas="/js/main.js" ></script>

		<script>
            $('email').isChanged(function () {
                    alert('jdnfjndfjkdfnjdfkdjf');
                    var t = $(this),
                        gravatar = '../../http://localhost::8000/profile/' + t.val();

                   	$('.apollo-image').css('backgroundImage', 'none');
                    $('<img />').attr('src', gravatar).imagesLoaded(function(){
                		$('.apollo-image').css('backgroundImage', 'url(http://localhost:8000/' + gravatar + ')');
                    });

                });
			$(function(){


				$('[name="optionsRadios"]').change(function(){
					if($(this).val() == 'yes'){
						window.location.href=".3.html"
					}
					else {
						window.location.href = '/';
					}
				});
			})
		</script>
	</body>
</html>