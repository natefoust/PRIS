<?php session_start(); ?>
<html>
<link rel="stylesheet" href="style.css" type="text/css"/>
<br><br><br><br><br><br><br><br>
<body background="4461.jpg">
<div class="auth" align="center" style="background-color: white; border: 2px solid;">
    <form method="POST" action="disp.php">
      <h2>АВТОРИЗАЦИЯ</h2>
      <h3>
        <div class="auth_input">
        <input type="text" name="auth_login" placeholder="Логин" /><br>
        <input type="password" name="auth_password" placeholder="Пароль" /><br>
      </div></h3>
        <input type="submit" name="auth_subm">

    </form>
</div>
</body>
</html>
