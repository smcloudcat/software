<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
session_start();
$directoryPath = '../';
require '../core/core.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['admin_loggedin'] = true;
        header('Location: index.php');
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>XiaoAdmin Login</title>
    <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="../layui/css/layui.css">
    <script src="../layui/layui.js"></script>
    <style>
        body {
            background: url('1.png') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2 class="layui-text">XiaoAdmin Login</h2>
        <form class="layui-form" action="login.php" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">账号</label>
                <div class="layui-input-block">
                    <input type="text" name="username" required lay-verify="required" placeholder="Enter Username" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">密码</label>
                <div class="layui-input-block">
                    <input type="password" name="password" required lay-verify="required" placeholder="Enter Password" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">Login</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
