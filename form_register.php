<?php

require_once("header.php");


?>


<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php
    //Если в сессии существуют сообщения об ошибках, то выводим их
    if (isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])) {
        echo $_SESSION["error_messages"];

        //Уничтожаем чтобы не выводились заново при обновлении страницы
        unset($_SESSION["error_messages"]);
    }

    //Если в сессии существуют радостные сообщения, то выводим их
    if (isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])) {
        echo $_SESSION["success_messages"];

        //Уничтожаем чтобы не выводились заново при обновлении страницы
        unset($_SESSION["success_messages"]);
    }
    ?>
</div>

<?php
//Проверяем, если пользователь не авторизован, то выводим форму регистрации,
//иначе выводим сообщение о том, что он уже зарегистрирован
if (!isset($_SESSION["email"]) && !isset($_SESSION["password"])) {
    ?>

    <div id="form_register">
        <h2>Register</h2>

        <form action="register.php" method="post" name="form_register">
            <table>
                <tbody>
                <tr>
                    <td> Name:</td>
                    <td>
                        <input type="text" name="first_name" required="required">
                    </td>
                </tr>

                <tr>
                    <td> Surname:</td>
                    <td>
                        <input type="text" name="last_name" required="required">
                    </td>
                </tr>

                <tr>
                    <td> Email:</td>
                    <td>
                        <input type="email" name="email" required="required"><br>
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>

                <tr>
                    <td> Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="6 characters minimum" required="required"><br>
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                </tr>
                <tr>
                    <td> Captcha:</td>
                    <td>
                        <p>
                            <img src="captcha.php" alt="Captcha"/> <br><br>
                            <input type="text" name="captcha" placeholder="Checking code" required="required">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit_register" value="Register">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <?php
} else {
    ?>
    <div id="authorized">
        <h2>Вы уже зарегистрированы</h2>
    </div>

    <?php
}

?>


<?php
//Подключение подвала
require_once("footer.php");
?>
