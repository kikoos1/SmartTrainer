<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm mail</title>
</head>
<body>
<p>Thanks for registering for our service.Please confirm your email</p>
    <a href="{{ URL::to('api/auth/register/code/' . $code) }}">Click here to validate</a>
</body>
</html>