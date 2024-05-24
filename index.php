<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
$directoryPath = './';
require 'core/core.php';

// 获取网站信息
$stmt = $pdo->query('SELECT * FROM site_info WHERE id = 1');
$software = $pdo->query('SELECT * FROM software');
$software_list = $software->fetchAll();
$site_info = $stmt->fetch();
?>



<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo htmlspecialchars($site_info['site_name']); ?></title>
<meta name="Keywords" content="<?php echo htmlspecialchars($site_info['site_keywords']); ?>">
<meta name="description" content="<?php echo htmlspecialchars($site_info['site_description']); ?>">
<meta name="applicable-device" content="mobile" />
<meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="layui/css/layui.css">
    <script src="layui/layui.js"></script>
    <style>
        body {
            background: url('admin/1.png') no-repeat center center fixed;
            background-size: cover;
        }
        .card {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            padding: 20px;
        }
        .layui-btn {
            border-radius: 10px;
        }

        .nav-box {
            background: rgba(255, 255, 255, 0.6);
            padding: 10px;
            border-radius: 10px;
            margin: 20px;
        }
        .content-box {
            background: rgba(255, 255, 255, 0.6);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            text-align: center;
        }
        .content-box2 {
            padding: 20px;
            border-radius: 10px;
            margin: 20px;
            text-align: center;
        }
        .transparent-input {
            background: rgba(255, 255, 255, 0.4);
            border: none;
            padding: 10px;
            border-radius: 5px;
        }
        .transparent-table {
            background: rgba(255, 255, 255, 0.2);
        }
        footer {
            text-align: center;
            margin: 20px;
            padding: 10px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 10px;
        }
        .card img {
            width: 50px;
            height: 50px;
        }
        @media (max-width: 768px) {
            .card img {
                width: 30px;
                height: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="layui-container">
    <div class="content-box">
        <h1><?php echo htmlspecialchars($site_info['site_name']); ?></h1><br>
        <p><?php echo nl2br(htmlspecialchars($site_info['site_announcement'])); ?></p>
    </div>
     <div class="layui-row layui-col-space15 content-box2">
            <?php foreach ($software_list as $software): ?>
                <div class="layui-col-sm12 layui-col-md4">
                    <div class="layui-card card">
                        <div class="layui-card-header">
                            <img src="<?php echo index($software['icon_path']); ?>" alt="Icon">
                            <?php echo $software['name']; ?> (<?php echo $software['version']; ?>)
                        </div>
                        <div class="layui-card-body">
                            <p><?php echo mb_strimwidth($software['concise'], 0, 100, '...'); ?></p><br>
                            <p>下载次数: <?php echo $software['download_count']; ?></p><br>
                            <a href="details.php?id=<?php echo $software['id']; ?>" class="layui-btn layui-btn-sm">查看</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
    <footer>
        <p><?php echo nl2br(htmlspecialchars($site_info['footer_content'])); ?></p>
    </footer> </div>
</body>
</html>
