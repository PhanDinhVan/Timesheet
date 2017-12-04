<!DOCTYPE>
<html>
<head>
	<title></title>
	<style type="text/css">
		.lastname{
			font-weight: bold;
			color: black;
		}
	</style>
</head>

<body>
	<p class="lastname">Hi {{ $lastname }}! </p>
	<p>You are receiving this email because we received a password reset request for your account. Please click the link to reset your password.</p>
	
	<a href="{{url('resetPass')}}/{{ $token }}">
		Change password
	</a>
	<p>If you did not request a password reset, no further action is required. It will expire in 30 minutes.</p>
	<p>Regards,</p>
	<p>Admin</p>
	
</body>
</html>