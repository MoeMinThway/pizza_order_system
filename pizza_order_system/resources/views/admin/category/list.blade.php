<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>

<body>
<h1>List Category from Admin</h1>
<h1> Role - {{Auth::user()->role}}</h1>
<form action="{{route('logout')}}" method="POST">
    @csrf
    <input type="submit" value="Log out" >
</form>

</body>
</html>
{{--  --}}
