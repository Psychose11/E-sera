<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_destroy();

echo '<script>';
echo 'if (typeof window.history.replaceState === "function") {';
echo '  window.history.replaceState({}, "", "../view/login_view.php");';
echo '}';
echo 'window.location.href = "../view/login_view.php";';
echo '</script>';
exit;
?>
