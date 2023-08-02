<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <style>
        .grad{
            background: rgb(100,151,192);
            background: linear-gradient(270deg, rgba(100,151,192,1) 0%, rgba(137,246,254,1) 100%);
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .main{
            width: 70%;
            height: 430px;
            padding: 35px;
            flex-shrink: 0;
            border-radius: 25px;
            background: #F6FBFD;
            margin:auto;
        }

        .main h3{
            font-family: Poppins;
            font-size: 32px;
            font-style: normal;
            font-weight: 600;
            line-height: 20px; /* 62.5% */
            color: #6597BF;
        }

        .icon-logo {
            margin: auto;
            width: 212px;
            height: 58px;
            margin-bottom: 36px;
        }

        .icon-logo img {
            width: 100%;
            height: 100%;
        }

        .form-login{
            margin-top: 50px;
        }

        .button-login{
            margin-top: 30px;
        }

        .button-login button{
            width: 100%;
        }
    </style>

</head>
<body class="grad">
    <div class="main">
        <div class="icon-logo">
            <img src="https://i.ibb.co/s9WKt6m/rp-horiz-2.png">
        </div>
        <h3 class="text-center">Login</h4>

        <div class="form-login">
            <form>
              <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              </div>
              <div class="form-group mt-3">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
              
              <div class="button-login">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
        </div>
    </div>
</body>
</html>