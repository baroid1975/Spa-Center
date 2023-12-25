<?php
require 'functions.php'; 
$login = $_POST['login'] ?? null; 
$password = $_POST['password'] ?? null; 

if(null !== $login || null !== $password) {
    $check = checkPassword($login, $password);
    if($check){
        session_start();
        $_SESSION['auth'] = true;
        $_SESSION['user'] = $login;
        $_SESSION['password'] = $password;
        header('location: index.php');
        exit(); 

    } else{
        $error = '<h2>Неверный логин или пароль. Попробуйте еще раз</h2>';
       
    }
}

$auth = $_SESSION['auth'];
?>

<?php
if(!$auth){ ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Document</title>
</head>
    <body>
       
        <?php if(isset($error)){ ?>
            <p><?php echo $error; ?></p>
        <?php } ?>

        <div class="hero">
         <hearder class="hearder">
        <div class="hearder-caption">
            <h1 class=hero-title style="color:black">SPA-Center</h1>  
        </div>
        <form action="#" method="post" class="hero-form">
        <h2 class=hero-title style="color:#551A8B">Вход на страницу сайта</h2>      
                        <label for="name" class="form-label">Логин</label>
                    <input type="text" login="login" name="login" required oninvalid="this.setCustomValidity('Введите Ваш логин')" oninput="setCustomValidity('')" placeholder="введите логин" value=""  class="form-input"> 
                        <label for="email" class="form-label">Пароль</label>
                    <input type="password" password="password" name="password" required oninvalid="this.setCustomValidity('Введите Ваш пароль')" oninput="setCustomValidity('')" placeholder="введите пароль" value="" class="form-input"> 
                    <button type="submit" class="form-btn">Войти</button>
                  
             <h2>Если Вы не зарегистрированны: <a href="/registration.php">Зарегистрироваться</a></h2>        
        </form>
        </hearder>
     </div> 
    </body>
</html>
<?php } ?>