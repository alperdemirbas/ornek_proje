<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<ul>
    @if (!empty($errors))
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    @endif
</ul>
<form method="POST" action="{{ _route('companies.login')}}">
    @csrf
    <label>
        <input type="text" name="email" required>
    </label>
    <label>
        <input type="password" name="password" required>
    </label>
    <button type="submit">Giris Yap</button>
</form>
</body>
</html>