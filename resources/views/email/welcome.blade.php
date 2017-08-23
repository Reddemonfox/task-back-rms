<html>
<head>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700" rel="stylesheet">
</head>
<body>
Hi {!! $user->name !!},<br><br>

Welcome to Study zone. To activate your account
<a href="www.manoj.com/api/users/{!! $user->id !!}/verify?token={!! $user->verificationCode !!}">click here</a>
</body>
</html>