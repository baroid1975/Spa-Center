<?php
 
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
require "functions.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login    = $_POST["login"];
    $password = $_POST["password"];
    if (existsUser($login)) { 
        $error = "<h2> Такой пользователь уже зарегистрирован</h2>";
    }
    elseif (null !== $login || null !== $password){ 
        addUser($login, $password); 
        header("location: login.php"); 
        exit(); 
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style2.css">

</head>

<body>
 
    <?php if (isset($error)) { ?>
        <p>
            <?php echo $error; ?>
        </p>
    <?php } ?>
    <div class="hero">
         <hearder class="hearder">
            <div class="hearder-caption">
                <h1 class=hero-title style="color:black">SPA-Center</h1>         
            </div>

            <form action="#" method="post" class="hero-form">
                <h2 class=hero-title style="color:#551A8B">Регистрация</h2>              
                            <label for="name" class="form-label">Логин</label>
                        <input type="text" login="login" name="login" required oninvalid="this.setCustomValidity('Введите Ваш логин')" oninput="setCustomValidity('')" placeholder="введите логин" value=""  class="form-input"> 
                        <label for="email" class="form-label">Пароль</label>
                        <input type="password" password="password" name="password" required oninvalid="this.setCustomValidity('Введите Ваш пароль')" oninput="setCustomValidity('')" placeholder="введите пароль" value="" class="form-input"> 
                        <button type="submit" class="form-btn">Зарегистрироваться</button>
                <h2> Если Вы зарегистрированы: <a href="/login.php">Войти</a></h2>
            </form>
         </hearder>
    </div>         
                  
</body>

</html>