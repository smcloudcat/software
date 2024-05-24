<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_name = $_POST['site_name'];
    $site_description = $_POST['site_description'];
    $site_keywords = $_POST['site_keywords'];
    $site_announcement = $_POST['site_announcement'];
    $footer_content = $_POST['footer_content'];

    $stmt = $pdo->prepare('INSERT INTO site_info (id, site_name, site_description, site_keywords, site_announcement, footer_content) 
                          VALUES (1, ?, ?, ?, ?, ?)
                          ON DUPLICATE KEY UPDATE 
                          site_name = VALUES(site_name), 
                          site_description = VALUES(site_description), 
                          site_keywords = VALUES(site_keywords), 
                          site_announcement = VALUES(site_announcement), 
                          footer_content = VALUES(footer_content)');
    if ($stmt->execute([$site_name, $site_description, $site_keywords, $site_announcement, $footer_content])) {
        $success = 'Site information updated successfully!';
    } else {
        $error = 'Failed to update site information.';
    }
}

// 获取当前网站信息
$stmt = $pdo->query('SELECT * FROM site_info WHERE id = 1');
$site_info = $stmt->fetch();

?>

<div class="layui-container">
    <div class="layui-row">
        <div class="content-box">
            <h2>设置网站信息</h2>
            <?php if (isset($success)): ?>
                <div class="layui-bg-green layui-text"><?php echo $success; ?></div>
            <?php elseif (isset($error)): ?>
                <div class="layui-bg-red layui-text"><?php echo $error; ?></div>
            <?php endif; ?>
            <form class="layui-form" action="set.php" method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label">网站名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="site_name" required lay-verify="required" value="<?php echo htmlspecialchars($site_info['site_name'] ?? ''); ?>" placeholder="Enter Site Name" autocomplete="off" class="layui-input transparent-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站描述</label>
                    <div class="layui-input-block">
                        <textarea name="site_description" required lay-verify="required" placeholder="Enter Site Description" class="layui-textarea transparent-input"><?php echo htmlspecialchars($site_info['site_description'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站关键词</label>
                    <div class="layui-input-block">
                        <input type="text" name="site_keywords" required lay-verify="required" value="<?php echo htmlspecialchars($site_info['site_keywords'] ?? ''); ?>" placeholder="Enter Site Keywords" autocomplete="off" class="layui-input transparent-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站公告</label>
                    <div class="layui-input-block">
                        <textarea name="site_announcement" required lay-verify="required" placeholder="Enter Site Announcement" class="layui-textarea transparent-input"><?php echo htmlspecialchars($site_info['site_announcement'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">底部内容</label>
                    <div class="layui-input-block">
                        <textarea name="footer_content" required lay-verify="required" placeholder="Enter Footer Content" class="layui-textarea transparent-input"><?php echo htmlspecialchars($site_info['footer_content'] ?? ''); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo">更新网站信息</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
