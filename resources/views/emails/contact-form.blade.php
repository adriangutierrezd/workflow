<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Consulta desde Worflow</h1>
    <p>Datos del usuario:</p>
    <ul>
        <li><b>Nombre: </b> {{$info[0]}}</li>
        <li><b>Email:</b> {{$info[1]}}</li>
    </ul>
    <p><b>Mensaje:</b></p>
    <p>{{$info[2]}}</p>
</body>
</html>