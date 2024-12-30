<?php
session_start();

unset($_SESSION['login_usu']);
unset($_SESSION['senha_usu']);
unset($_SESSION['perfil_usu']);
session_destroy();

header("Location: index.php");

?>