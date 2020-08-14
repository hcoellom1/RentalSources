<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Estimado(a) señor(a) &nbsp; {{ $name }},
    
    <br>
    Gracias por registrarse con nostros. No olvide completar su registro.    

    <p>
    <br> Por favor siga el siguiente enlace o copie y pegue en la barra de direcciones de su navegador para confirmar su correo electrónico
    </p>
    
    <p>
    <br>
    <a href="{{ url('verify', $verification_code)}}">Confirmar mi correo electrónico </a>
    </p>

    <br/>

</div>

</body>
</html>