<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('UPDATE users SET username = ?, password = ? WHERE id = 1');
    if ($stmt->execute([$username, $hashed_password])) {
        $success = 'Credentials updated successfully!';
    } else {
        $error = 'Failed to update credentials.';
    }
}

// 获取当前管理员信息
$stmt = $pdo->query('SELECT * FROM users WHERE id = 1');
$admin = $stmt->fetch();
?>

    <div class="layui-row">
        <div class="content-box">
            <h2>管理员账号</h2>
            <?php if (isset($success)): ?>
                <div class="layui-bg-green layui-text"><?php echo $success; ?></div>
            <?php elseif (isset($error)): ?>
                <div class="layui-bg-red layui-text"><?php echo $error; ?></div>
            <?php endif; ?>
            <form class="layui-form" action="change_credentials.php" method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label">账号</label>
                    <div class="layui-input-block">
                        <input type="text" name="username" required lay-verify="required" value="<?php echo htmlspecialchars($admin['username']); ?>" placeholder="Enter New Username" autocomplete="off" class="layui-input transparent-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="password" required lay-verify="required" placeholder="Enter New Password" autocomplete="off" class="layui-input transparent-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="formDemo">更新信息</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php include 'footer.php'; ?>
