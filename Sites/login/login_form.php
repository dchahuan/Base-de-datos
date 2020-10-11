<?php
    include "../components/head.php"
?>

<body>
    <form action="scripts/login_checker.php" method="POST">
        <input type="text" name="pid" placeholder="Numero de pasaporte">
        <input type="password" name="pass" placeholder="Password">
        <button type="submit" name="login-submit">Login</button>
    </form>

    <a href="signup.php">Signup</a>

</body>

</html>