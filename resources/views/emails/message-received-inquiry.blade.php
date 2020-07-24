<!DOCTYPE html>
<html lang="en" >
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud recibida</title>
</head>
<body>
    <p>Se ha realizado una nueva solicitud de renta desde la plataforma web.
    </p>
    <p>
        <ul>
            <li>Id de solicitud: {{ $requestId }}</li>
        </ul>
    </p>
    <p><h1>Los datos del cliente son</h1></p>    
    
    <ul>
        <li>Nombre: {{ $request->getname()  }}</li>        
        <li>Correo electr&oacute;nico {{ $request->getEmail()  }}</li>
        <li>Tel&eacute;fono: {{ $request->getPhone() }}</li>
    </ul>

    <p><h1>El detalle de la maquinaria solicitada es</h1></p>
    <table>
        <thead>
            <tr>
                <th>Maquina</th>
                <th>Telefono duenio</th>
                <th>Correo del duenio</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach ($machines as $machine)
            <tr>
                <td>{{ $machine->Nombre_maquinaria }}</td>
                <td>{{ $machine->telefono }}</td>
                <td>{{ $machine->Correo_Electronico }}</td>
            </tr>
            @endforeach
                        
        </tbody>
    </table>

    <p>         
        <a href="http://127.0.0.1:8000/login">Atender solicitud</a> 
    </p>

</body>
</html>