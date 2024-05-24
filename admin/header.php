<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
$directoryPath = '../';
require '../core/core.php';
session_start();
$xiao=base64_decode($get);

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>小猫咪软件库</title>
<meta name="Keywords" content="小猫咪软件库">
<meta name="description" content="小猫咪软件库，分享实用软件">
<meta name="applicable-device" content="mobile" />
<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="../layui/css/layui.css">
    <script src="../layui/layui.js"></script>
    <script src="https://cdn.lwcat.cn/jquery/jquery.js"></script>
    <style>
        body {
            background: url('1.png') no-repeat center center fixed;
            background-size: cover;
        }
        .nav-box {
            background: rgba(255, 255, 255, 0.3);
            padding: 10px;
            border-radius: 10px;
            margin: 20px;
        }
        .content-box {
            background: rgba(255, 255, 255, 0.6);
            padding-right: 20px;
            padding-bottom: 20px;
            padding-top: 20px;
            padding-left: 10px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }
        .content-box h2{
            text-align: center;
        }
        .transparent-input {
            background: rgba(255, 255, 255, 0.3);
            border: none;
            padding: 10px;
            border-radius: 5px;
        }
        .transparent-table {
            background: rgba(255, 255, 255, 0.2);
            padding-left: 20px;
        }
        .content-boxmanage {
            background: rgba(255, 255, 255, 0.6);
            padding-right: 20px;
            padding-bottom: 20px;
            padding-top: 20px;
            padding-left: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }
        .content-boxmanage h2{
            text-align: center;
        }
        footer {
            text-align: center;
            margin: 20px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 10px;
        }
        .images-preview img {
            width: 20%;
            height: 20%;
            border: 2px solid white;
            padding: 10px;
        }
        @media (max-width: 768px) {
            .images-preview img {
                width: 20%;
                height: 20%;
            }
        }
    </style>
</head>
<body>
    <div class="layui-container">
    <div class="nav-box">
        <ul class="layui-nav layui-bg-gray">
            <li class="layui-nav-item"><a href="index.php">首页</a></li>
            <li class="layui-nav-item"><a href="set.php">基本设置</a></li>
            <li class="layui-nav-item"><a href="add.php">添加软件</a></li>
            <li class="layui-nav-item"><a href="manage.php">管理软件</a></li>
            <li class="layui-nav-item"><a href="change.php">账号密码</a></li>
            <li class="layui-nav-item"><a href="update.php">检查更新</a></li>
            <li class="layui-nav-item"><a href="logout.php">退出登录</a></li>
        </ul>
    </div>
