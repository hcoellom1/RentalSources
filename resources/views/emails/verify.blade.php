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
    <br> Por favor siga el siguiente enlace o copie y pegue en la barra de direcciones de su navegador para confirmar su correo
    </p>
    
    <p>
    <br>
    <a href="{{ url('user/verify', $verification_code)}}">Confirm my email address </a>
    </p>

    <br/>

</div>

</body>
</html>