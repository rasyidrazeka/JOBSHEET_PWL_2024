<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        .*{
            margin: 0;
            padding: 0;
        }
        .logo-trans{
            width: 339px;
            height: 69px;
        }
        .card-body-cus{
            width: 715px !important;
            height: 544px !important;
            border-radius: 46px;
            background-color: white;
        }
        .form-cus{
            width: 535px;
            height: 64px;
            border-color: black;
        }
        .btn-login-cus{
            width: 535px;
            height: 64px;
            background-color: #FF8413;
            border: 0px;
            border-radius: 6px;
            font-size: 24px;
            font-weight: bold;
            color: white;
            font-family: "Inter", sans-serif;
        }
        .btn-login-cus:hover{
            background-color: red;
            color: white;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body style="background-color: #FF8413">
    <br><br>
    <div class="container-fluid d-flex flex-column card-body card-body-cus justify-content-center align-items-center text-center mt-5">
        <img src="{{ asset('img/logo transparan.png') }}" alt="logo" class="logo-trans my-3">
        <form action="" method="get" class="d-flex flex-column m-5">
            <input type="email" class="form-control-lg form-cus mb-4" placeholder="Email">
            <input type="password" class="form-control-lg form-cus mb-4" placeholder="Password">
            <button type="submit" class="btn-primary btn-login-cus mt-4">MASUK</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>