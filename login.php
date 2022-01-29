<?php

session_start();

$message = '';

if (isset($_SESSION['loggedin'])) {
    header('location:feed.php');
}

if (isset($_POST["login"])) {
    if ($_POST["username"] === "admin") {
        // admin pass - "password"
        if (md5($_POST["password"]) === "5f4dcc3b5aa765d61d8327deb882cf99") {
            $_SESSION["loggedin"] = true;
            header('location:feed.php');
        } else {
            $message = "<label>Неверный пароль</labe>";
        }
    } else {
        $message = "<label>Неверное имя пользователя</labe>";
    }
}

?>

<html>

<head>
    <title>WordSkills Blog</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <form method="post">
            <p class="text-danger"><?php echo $message; ?></p>
            <div class="form-group">
                <label>Имя пользователя</label>
                <input type="text" name="username" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="submit" name="login" class="btn btn-info" value="Login" />
            </div>
        </form>
    </div>
</body>

</html>