<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
$directoryPath = './';
require 'core/core.php';

if (!isset($_GET['id'])) {
    die('Software ID is required');
}

$id = $_GET['id'];

// 获取软件详情
$stmt = $pdo->prepare('SELECT * FROM software WHERE id = ?');
$stmt->execute([$id]);
$software = $stmt->fetch();

// 更新下载次数
$stmt = $pdo->prepare('UPDATE software SET download_count = download_count + 1 WHERE id = ?');
$stmt->execute([$id]);

// 获取软件图片
$stmt = $pdo->prepare('SELECT image_path FROM software_images WHERE software_id = ?');
$stmt->execute([$id]);
$images = $stmt->fetchAll();


// 获取网站信息
$info = $pdo->query('SELECT * FROM site_info WHERE id = 1');
$site_info = $info->fetch();
?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
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
            background: rgba(255, 255, 255, 0.3);
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
            width: 20%;
            height: 20%;
            border: 2px solid white;
            padding: 10px;
        }
        @media (max-width: 768px) {
            .card img {
                 width: 20%;
            height: 20%;
            }
        }
        .right-aligned {
        direction: rtl; /* 设置文本方向为从右到左 */
        text-align: left; /* 将文本内容左对齐 */
    }
    </style>
</head>
<body>
    <div class="layui-container">
    <div class="content-box">
        <h1><?php echo htmlspecialchars($site_info['site_name']); ?></h1><br>
        <p><?php echo nl2br(htmlspecialchars($site_info['site_announcement'])); ?></p>
    </div>
        <div class="layui-card card content-box">
            <div class="layui-card-header"><?php echo $software['name']; ?> <a href="<?php echo index($software['file_path']); ?>" class="layui-btn layui-layout-right">下载</a></div>
            <div class="layui-card-body">
                <p><strong>介绍:</strong> <?php echo $software['details']; ?></p><br>
                <p><strong>更新内容:</strong> <?php echo $software['update_info']; ?></p><br>
                <p><strong>Version:</strong> <?php echo $software['version']; ?></p><br>
               <h3>Current Images</h3>
            <div class="images-preview">
                <?php foreach ($images as $image): ?>
                    <img src="<?php echo index($image['image_path']); ?>" onclick="showImage('<?php echo index($image['image_path']); ?>')" alt="Image">
                <?php endforeach; ?>
            </div>
                </div>
            
        </div>
    <footer>
        <p><?php echo nl2br(htmlspecialchars($site_info['footer_content'])); ?></p>
    </footer> </div>
    <script>
        layui.use('layer', function() {
            var layer = layui.layer;

            window.showImage = function(imagePath) {
                layer.open({
                    type: 1,
                    title: false,
                    closeBtn: 0,
                    area: '80%',
                    shadeClose: true,
                    content: '<img src="' + imagePath + '" style="width: 100%;">'
                });
            };
        });
    </script>
</body>
</html>
