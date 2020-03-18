<?php

require_once("header.php");


?>



<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php

    if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
        echo $_SESSION["error_messages"];

        //Уничтожаем чтобы не появилось заново при обновлении страницы
        unset($_SESSION["error_messages"]);
    }

    if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
        echo $_SESSION["success_messages"];

        //Уничтожаем чтобы не появилось заново при обновлении страницы
        unset($_SESSION["success_messages"]);
    }
    ?>
</div>

<?php
//Проверяем, если пользователь не авторизован, то выводим форму авторизации,
//иначе выводим сообщение о том, что он уже авторизован
if(!isset($_SESSION["email"]) && !isset($_SESSION["password"])){
    ?>

    <div id="form_auth">
        <h2>Log In</h2>
        <form action="auth.php" method="post" name="form_auth" >
            <table>

                <tr>
                    <td> Email: </td>
                    <td>
                        <input type="email" name="email" required="required" /><br />
                        <span id="valid_email_message" class="mesage_error"></span>
                    </td>
                </tr>

                <tr>
                    <td> Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="6 characters minimum" required="required" /><br />
                        <span id="valid_password_message" class="mesage_error"></span>
                    </td>
                </tr>

                <tr>
                    <td> Captcha: </td>
                    <td>
                        <p>
                            <img src="captcha.php" alt="Капча" /> <br />
                            <input type="text" name="captcha" placeholder="" />
                        </p>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="btn_submit_auth" value="Log In" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
}else{
    ?>
    <div id="authorized">
        <h2>You are already logged in</h2>
    </div>

    <?php
}
?>


<?php
//Подключение подвала
require_once("footer.php");
?>
