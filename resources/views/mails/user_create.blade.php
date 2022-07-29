<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
</head>
<body>
    <p>Hola! {{ $emailData->name }}.</p>
    <p>Tu usuario ha sido creado!</p>
    <ul>
        <li>user: {{ $emailData->email }}</li>
        <li>password: {{ $emailData->pass }}</li>
    </ul>
    <p>{{ $emailData->updated_at }}</p>
</body>
</html>