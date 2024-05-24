<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
session_start();
session_destroy();
header('Location: login.php');
exit;
?>
