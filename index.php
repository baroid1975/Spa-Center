<?php
session_start(); 
require 'functions.php';

if ($_GET['action'] === 'logout') {
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', 0); 
    }
    $daysUntilBirthday = null;
    session_destroy(); 
    header('location: index.php');
}

// Скидка в течении суток часов
$loginTime     = $_SESSION['logtime'];
$remainingTime = 86400 - (time() - $loginTime);
if ($remainingTime > 0) {
    $hours   = floor($remainingTime / 3600);
    $minutes = floor(($remainingTime % 3600) / 60);
    $seconds = $remainingTime % 60;
} else {
    $hours   = 0;
    $minutes = 0;
    $seconds = 0;
}

// День рождения
if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
    $birthday             = $_POST['birthday'];
    $_SESSION['birthday'] = $birthday;
    $daysUntilBirthday    = calculateDaysUntilBirthday($birthday);
    $discountMessage      = getDiscountMessage($birthday, $daysUntilBirthday);
}

if (isset($_SESSION['birthday'])) {
    $birthday          = $_SESSION['birthday'];
    $daysUntilBirthday = calculateDaysUntilBirthday($birthday);
    $discountMessage   = getDiscountMessage($birthday, $daysUntilBirthday);
} else {
    $daysUntilBirthday = null;
    $discountMessage   = "";
}
?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SPA-salon</title>
        <link rel="stylesheet"  href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sometype+Mono:ital@1&family=Urbanist:wght@400;600&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
        
        ?>
<div class="body"> 
              <nav class="nav">
                <ul class="nav_list">
                    <li class="nav-item">
                        <a class="nav-link" href="">УСЛУГИ SPA-СENTER</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">НАШИ КОНТАКТЫ</a> 
                    </li>    
                    <?php
                    if(!isset($_SESSION['user'])){
                    ?> 
                    <li class="nav-item">
                         <a class="nav-link" href="registration.php">РЕГИСТРАЦИЯ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">ВХОД</a> 
                     </li>   
                    <?php }else{
                    ?> 
                    <li class="nav-item">
                    <a class="nav-link" href="/?action=logout">ВЫХОД</a>
                    </li>
                    <?php } ?> 
                </nav>

            <div class="hero">
  <hearder class="hearder">
    <div class="hearder-caption">
        <h1 class="hero-title">Добро пожаловать в SPA-Center <?php echo $_SESSION['user']; ?></h1>
            <br>
        <h2> Все лучшее для Вас!</h2>
            <br>
    </div>
  </hearder>

  </div>
  <article>
    <div class="service">
      <div class="service-container">
          <div class="container-body">
              <div class="service">
                  <h3>Услуги SPA-Center</h3>
              </div>
              <div class="description-services">
                  <span class="description">Массаж для двоих 2000p.</span>
                  <span class="description">Аромотерапия. От 1200p.</span>
                  <span class="description">Массаж в парилке. От 1500p.</span>
                  
              </div>
             
              <div class="img">
                  <img src="./img/mixmassage.jpg" alt="mixmassage" width= "480px" height = "300px">
                  <img src="./img/aromo.jpg" alt="aromo" width= "480px" height = "300px"> 
                  <img src="./img/bath.jpg" alt="bath" width= "480px" height = "300px"> 
                 
              </div>
          </div>  
      </div>
  </div>
</article>

<footer>
    
<div class="discount-sales">
        <div class="container"> 
            <?php 
                if(isset($_SESSION['user'])){
            ?>
            <div class="sale">
                <p>Спешите получить скидку до 15% на весь ассортимент в течение 24 часов!</p>
                <p>Время действия акции:
                    <?php echo "$hours часов, $minutes минут, $seconds секунд"; ?>
                </p>
                
            </div>
            <?php } ?>
            <div class="birthday">
                <?php if (!isset($_SESSION['$birthday'])) { ?>
                    <p>
                        <?php echo $discountMessage; ?>
                    </p>
                <?php } ?>
                <?php if(!isset($_SESSION["birthday"])){ ?>
                <form method="post" action="">
                    <label for="birthday">Для персонального предложения внесите дату рождения:</label><br>
                    <br><input type="date" id="birthday" name="birthday" required>
                    <input type="submit" value="Ввести">
                </form>
                <?php } ?>
            </div> 
         </div> 
 </div>  
</footer>
                
        
        
    </body>
</html>