<?php
//Добавляем файл подключения к БД
require_once("dbconnect.php");

if(isset($_POST["email"])) {

    $email =  trim($_POST["email"]);

    $email = htmlspecialchars($email, ENT_QUOTES);

    //Проверяем, нет ли уже такого адреса в БД.
    $result_query = $mysqli->query("SELECT `email` FROM `users` WHERE `email`='".$email."'");

    //Если кол-во полученных строк ровно единице, значит, пользователь с таким почтовым адресом уже зарегистрирован
    if($result_query->num_rows == 1){

        echo "<span class='mesage_error'>A user with this email address is already registered</span>";

    }else{
        echo "<span class='success_message'>Free mailing address</span>";
    }

    // закрытие выборки
    $result_query->close();
}
?>
