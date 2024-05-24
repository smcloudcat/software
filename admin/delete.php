<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
include 'header.php';

// 检查是否有软件 ID 被提交
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: login.php');
    exit;
}

// 首先删除与软件相关联的图片
$stmt = $pdo->prepare('DELETE FROM software_images WHERE software_id = ?');
$stmt->execute([$id]);

// 然后再从数据库中删除软件
$stmt = $pdo->prepare('DELETE FROM software WHERE id = ?');
if ($stmt->execute([$id])) {
    $success = 'Software deleted successfully!';
} else {
    $error = 'Failed to delete software.';
}
?>

<div class="layui-container">
    <div class="layui-row">
        <div class="layui-col-md12 content-box">
            <?php if (isset($success)): ?>
                <div class="layui-bg-green layui-text"><?php echo $success; ?></div>
            <?php elseif (isset($error)): ?>
                <div class="layui-bg-red layui-text"><?php echo $error; ?></div>
            <?php endif; ?>
            <p><a href="manage.php">返回</a></p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
