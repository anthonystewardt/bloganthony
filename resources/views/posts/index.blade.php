<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @production
        <h1>Estamos en production</h1>
    @else
        <h1>Estamos en desarrollo</h1>
    @endproduction


</body>
</html>
