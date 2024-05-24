<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
include 'config.php';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo ' <script>function autoPopup() {if (confirm("你的网站链接数据库似乎失败了，重新按照下吧")) {window.location.href = "install.php";}}window.onload = autoPopup;</script>';
}
function index($url) {
$new_string = str_replace('../', "", $url);
return $new_string;
}
$lockFileName = 'install.lock';
if (file_exists($directoryPath . DIRECTORY_SEPARATOR .$lockFileName)) {
} else {
    echo '<script>function autoPopup() {if (confirm("你的网站没有安装锁，看起来是没安装吗？请前往安装吧")) {window.location.href = "install.php";}}window.onload = autoPopup;</script>';
}