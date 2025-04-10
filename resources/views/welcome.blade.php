<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}">
    <style>
        body {
            /*background-color: #002883;*/
            margin: 0;
            height: 100vh;
            background: linear-gradient(45deg, #002883 50%, rgb(255, 255, 255) 50%);
        }

        .texto {
            position: absolute;
            left: 45%;
            top: 25vh;
        }

        .img {
            position: absolute;
            left: 15%;
            top: 10vh;
        }

        h1 {
            color: #002883;
        }

        /**/
        .btn {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: white;
            color: #002883;
            border: 3px solid #002883;
        }

        .btn-login:hover {
            background-color: #002883;
            color: white;
            transform: translateY(-3px);
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        .btn-register {
            background-color: #002883;
            color: white;
            border: 3px solid #002883;
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .btn-register:hover {
            background-color: white;
            color: #002883;
            transform: translateY(-3px);
        }

        .btn-register:active {
            transform: translateY(1px);
        }

        .buttons-container {
            position: absolute;
            top: 50vh;
            left: 50%;
            transform: translateX(-50%);
        }

        .emilio {
            position: absolute;
            top: 90vh;
            left: 44%;
        }

        h2 {
            color: white;
        }
    </style>
</head>

<body>
    <div class="img">
        <img src="{{ asset('img/SIMJ.png') }}" alt="">
    </div>
    <div class="texto">
        <h1>SOLUCIONES</h1>
        <h1>INFORMATICAS MJ</h1>
    </div>

    <div class="buttons-container">
        <a href="{{ route('login') }}" class="btn btn-login">Iniciar sesión</a>
        <a href="{{ route('register') }}" class="btn btn-register">Registrarse</a>
    </div>

    <div class="emilio">
        <h2>EMILIO LOPEZ LEON</h2>
    </div>

</body>

</html>