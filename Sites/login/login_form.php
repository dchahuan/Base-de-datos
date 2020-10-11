<?php
    include "../components/head.php"
?>

<body>
    <form action="scripts/login_checker.php" method="POST">
        <input type="text" name="pasaporte" placeholder="Numero de pasaporte">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit" name="login-submit">Login</button>
    </form>

    <a href="signup.php">Signup</a>

</body>

</html>