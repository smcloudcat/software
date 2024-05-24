<?php
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $version = $_POST['version'];
    $details = $_POST['details'];
    $concise = $_POST['concise'];
    $update_info = $_POST['update_info'];
    
    // 处理软件图标上传
    $icon_path = '../uploads/' . basename($_FILES['icon']['name']);
    move_uploaded_file($_FILES['icon']['tmp_name'], $icon_path);
    
    // 处理介绍图片上传
    $image_paths = [];
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        if (!empty($_FILES['images']['name'][$key])) {
            $image_path = '../uploads/' . basename($_FILES['images']['name'][$key]);
            move_uploaded_file($tmp_name, $image_path);
            $image_paths[] = $image_path;
        }
    }

    // 处理软件文件上传
    $file_path = '../uploads/' . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $file_path);

    $stmt = $pdo->prepare('INSERT INTO software (name, version, details, concise, update_info, icon_path, file_path) VALUES (?, ?, ?, ?, ?, ?, ?)');
    if ($stmt->execute([$name, $version, $details, $concise, $update_info, $icon_path, $file_path])) {
        $software_id = $pdo->lastInsertId();
        // 插入介绍图片
        foreach ($image_paths as $image_path) {
            $stmt = $pdo->prepare('INSERT INTO software_images (software_id, image_path) VALUES (?, ?)');
            $stmt->execute([$software_id, $image_path]);
        }
        $success = 'Software added successfully!';
    } else {
        $error = 'Failed to add software.';
    }
}
?>
    <div class="layui-container">
        <div class="layui-row">
            <div class="content-box">
                <h2>添加软件</h2>
                <?php if (isset($success)): ?>
                    <div class="layui-bg-green layui-text"><?php echo $success; ?></div>
                <?php elseif (isset($error)): ?>
                    <div class="layui-bg-red layui-text"><?php echo $error; ?></div>
                <?php endif; ?>
                <form class="layui-form" action="add.php" method="post" enctype="multipart/form-data">
                    <div class="layui-form-item">
                        <label class="layui-form-label">软件名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" required lay-verify="required" placeholder="Enter Software Name" autocomplete="off" class="layui-input transparent-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Version</label>
                        <div class="layui-input-block">
                            <input type="text" name="version" required lay-verify="required" placeholder="Enter Software Version" autocomplete="off" class="layui-input transparent-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">首页简介</label>
                        <div class="layui-input-block">
                            <textarea name="concise" required lay-verify="required" placeholder="Enter Software Concise" class="layui-textarea transparent-input"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">软件详细</label>
                        <div class="layui-input-block">
                            <textarea name="details" required lay-verify="required" placeholder="Enter Software Details" class="layui-textarea transparent-input"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">更新内容</label>
                        <div class="layui-input-block">
                            <textarea name="update_info" required lay-verify="required" placeholder="Enter Update Info" class="layui-textarea transparent-input"></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Icon</label>
                        <div class="layui-input-block">
                            <input type="file" name="icon" accept="image/*" required lay-verify="required">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">展示图片</label>
                        <div class="layui-input-block">
                            <input type="file" name="images[]" multiple accept="image/*">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">上传软件文件</label>
                        <div class="layui-input-block">
                            <input type="file" name="file" accept=".exe,.zip,.rar,.7z,.apk,.app" required lay-verify="required">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn layui-btn-radius" lay-submit lay-filter="formDemo">添加软件</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</div>
<?php include 'footer.php'; ?>