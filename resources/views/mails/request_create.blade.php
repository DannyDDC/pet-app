<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
</head>
<body>
    <p>Hola! {{ $emailData->name }}.</p>
    <p>Alguien esta solcitando info de tu mascota {{ $emailData->pet_name }}!</p>
    <p>Datos del solicitante:</p>
    <ul>
        <li>nombre: {{ $emailData->nombre }}</li>
        <li>email: {{ $emailData->correo_electronico }}</li>
        <li>contacto: {{ $emailData->telefono }}</li>
        <li>ciudad: {{ $emailData->ciudad }}</li>
        <li>motivo: {{ $emailData->motivo }}</li>
    </ul>
    <p>{{ $emailData->updated_at }}</p>
</body>
</html>