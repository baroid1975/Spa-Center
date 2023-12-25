<?php
function users(){
   
    $file_json = "users.json";
    $json      = file_get_contents($file_json); 
    $users     = json_decode($json, true); 
    return $users;
}

function existsUser($login){
    $users = users();
  
    foreach ($users as $user) {
      
        if($user['login'] === $login){
            return true;
        }
    }
    return false;
}

// Добавление пользователя в БД
function newUser($login, $password){
    $file_json  = "users.json";
    $hashedPas = password_hash($password, PASSWORD_DEFAULT); 
    $json = file_get_contents($file_json);
    $data = json_decode($json, true);
    $data[] = [
        'login'    => $login,
        'password' => $hashedPas
    ];
    $jsonString = json_encode($data, JSON_PRETTY_PRINT); 

    $fp = fopen($file_json, 'w'); 
    fwrite($fp, $jsonString); 
    fclose($fp); 
}

// Проверка ввода пароля
function checkPassword($login, $password){
    $users = users();
    foreach($users as $user){
        if($user['login'] == $login){
            return password_verify($password, $user['password']); 
    }
    return false;
}
}
// Определение имени пользователя
function getCurrentUser(){
    if(isset($_SESSION['user'])){
        return $_SESSION['user'];
    } else {
        return null;
    }
}

function calculateDaysUntilBirthday($birthday)
{
    $today    = new DateTime();
    $birthday = new DateTime($birthday);
    $birthday->setDate($today->format('Y'), $birthday->format('m'), $birthday->format('d'));

    if ($today > $birthday) {
        $birthday->modify('+1 year');
    }

    $interval = $today->diff($birthday);
    return $interval->days;
}

function getDiscountMessage($birthday, $daysUntilBirthday)
{
    $today    = new DateTime();
    $birthday = new DateTime($birthday);
    $birthday->setDate($today->format('Y'), $birthday->format('m'), $birthday->format('d'));

    if ($today->format('md') === $birthday->format('md')) {
        return "С днем ​​рождения! Получите скидку 15% на все услуги салона!";
    } else {
        return "Спешите! До дня рождения осталось -  " . $daysUntilBirthday . " дней!";
    }
}