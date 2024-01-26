<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello this is the homepage!</h1>
    <p>The current year its {{date('Y')}}</p>
    <p>My Favorite number is {{ 2 + 2 }}</p>
    <h3>{{ $name }}</h3>

    <ul>
        @foreach ($allAnimals as $animal)
            <li>{{ $animal }}</li>
        @endforeach
    </ul>
    <a href="/about-us">About us!!</a>
</body>
</html>