<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Test Caching</title>
</head>

<body>
    <div>
        <h1>Top articles</h1>
        @foreach ($articles as $article)
        <li>{{ $article }}</li>
        @endforeach
    </div>
</body>

</html>
