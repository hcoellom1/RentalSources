<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud recibida</title>
</head>
<body>
    <p>Gracias por utilizar nuestra plataforma, en unos instantes
       uno de nuestros agentes se contactar&aacute; con usted
       para completar su solicitud.
    </p>
    <p>Sus datos</p>    
    
    <ul>
        <li>Nombre: {{ $request->getname()  }}</li>        
        <li>Correo electr&oacute;nico: {{ $request->getEmail()  }}</li>
        <li>Tel&eacute;fono: {{ $request->getPhone() }}</li>
    </ul>

    
    <p>Atentamente Rental Maquinaria & Equipo &copy;</p>

</body>
</html>