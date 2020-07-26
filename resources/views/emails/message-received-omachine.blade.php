<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Petición de renta de maquinaria</title>
</head>
<body>
    <p>Estimado(a) señor(a):</p>
    <p><h2>{{ $machines->Nombre.' '.$machines->apellidos }} Nos complace informarle que tiene una petición de renta de su maquinaria</h2></p>
    
    <p><h1>Los datos de la solicitud son los siguientes:</h1></p>    
    
    <ul>
        <li>Fecha de la solicitud:  {{ $machines->Fecha_solicitud }}</li>        
        <li>Dirección: {{ $machines->direccionProyecto }}</li>
    </ul>

    <p>Agradecemos responda a este correo indicando la disponibilidad</p>

    <p><h1>El detalle de la maquinaria solicitada es el siguiente</h1></p>
    <ul>
        <li>Máquina: {{ $machines->Nombre_maquinaria }} &nbsp; {{ $requestTime }}</li>
    </ul>
    
    <p>Atentamente Rental Maquinaria & Equipo &copy;</p>

</body>
</html>