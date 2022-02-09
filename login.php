<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <style>
    body {
        width: 30%;
        margin: 0 auto;
        margin-top: 200px;
    }
    </style>
</head>

<body>
    <form action="login.php" method="POST">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username"
                aria-describedby="basic-addon1" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input name="password" type="password" class="form-control" placeholder="Password" aria-label="Username"
                aria-describedby="basic-addon1" required>
        </div>
        <div class="form-check">
            <input class="form-check-input"  type="checkbox" name="remember" value=1 id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Default checkbox
            </label>
        </div>
        <div class="input-group mb-3">
            <input type="submit" class="btn btn-success" name="login" placeholder="Login" aria-label="Username"
                aria-describedby="basic-addon1">
        </div>

    </form>
</body>

</html>
<?php
session_start();

require "account.php";
if (isset($_POST['login']) && $_POST['login']) {
    $account = new account;
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = $_POST['remember'];
    $password_hashed = $account->login($username);
    if ($password_hashed) {
        $verify = password_verify($password, $password_hashed['password']);
        if ($verify) {
            $_SESSION['id'] = $password_hashed['id'];
            if($remember == 1){
                setcookie('remember',$password_hashed['id'], time()+3600*24*7);
            }
            header("location: index.php");
        } else {
            echo 'Incorrect Password!';
        }
    }else{
        echo"User not register";
    }

  
}
?>