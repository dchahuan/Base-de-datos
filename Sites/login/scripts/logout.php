<?php

session_start();
session_unset();
session_destroy();

header("Location: /~grupo16/index.php");
exit();