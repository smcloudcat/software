<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $version = $_POST['version'];
    $details = $_POST['details'];
    $concise = $_POST['concise'];
    $update_info = $_POST['update_info'];
    
    // 检查是否有新的软件图标上传
    if (!empty($_FILES['icon']['tmp_name'])) {
        $icon_path = '../uploads/' . basename($_FILES['icon']['name']);
        move_uploaded_file($_FILES['icon']['tmp_name'], $icon_path);
        $stmt = $pdo->prepare('UPDATE software SET icon_path = ? WHERE id = ?');
        $stmt->execute([$icon_path, $id]);
    }
    
    // 处理新的介绍图片上传
    if (!empty($_FILES['images']['tmp_name'][0])) {
        $image_paths = [];
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $image_path = '../uploads/' . basename($_FILES['images']['name'][$key]);
            move_uploaded_file($tmp_name, $image_path);
            $image_paths[] = $image_path;
        }
        // 删除原有的介绍图片记录
        $stmt = $pdo->prepare('DELETE FROM software_images WHERE software_id = ?');
        $stmt->execute([$id]);
        // 插入新的介绍图片
        foreach ($image_paths as $image_path) {
            $stmt = $pdo->prepare('INSERT INTO software_images (software_id, image_path) VALUES (?, ?)');
            $stmt->execute([$id, $image_path]);
        }
    }

    // 处理软件文件上传
    if (!empty($_FILES['file']['tmp_name'])) {
        $file_path = '../uploads/' . basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
        $stmt = $pdo->prepare('UPDATE software SET file_path = ? WHERE id = ?');
        $stmt->execute([$file_path, $id]);
    }

    $stmt = $pdo->prepare('UPDATE software SET name = ?, version = ?, details = ?, concise = ?, update_info = ? WHERE id = ?');
    if ($stmt->execute([$name, $version, $details, $concise, $update_info, $id])) {
        $success = 'Software updated successfully!';
    } else {
        $error = 'Failed to update software.';
    }
}

// 获取软件信息
$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: manage.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM software WHERE id = ?');
$stmt->execute([$id]);
$software = $stmt->fetch();

// 获取软件介绍图片
$stmt = $pdo->prepare('SELECT * FROM software_images WHERE software_id = ?');
$stmt->execute([$id]);
$images = $stmt->fetchAll();
?>
    <div class="layui-container">
        <div class="layui-row">
            <div class="content-box">
                <h2>编辑软件</h2>
                <?php if (isset($success)): ?>
                    <div class="layui-bg-green layui-text"><?php echo $success; ?></div>
                <?php elseif (isset($error)): ?>
                    <div class="layui-bg-red layui-text"><?php echo $error; ?></div>
                <?php endif; ?>
                <form class="layui-form" action="edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $software['id']; ?>">
                    <div class="layui-form-item">
                        <label class="layui-form-label">软件名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" required lay-verify="required" value="<?php echo htmlspecialchars($software['name']); ?>" placeholder="Enter Software Name" autocomplete="off" class="layui-input transparent-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Version</label>
                        <div class="layui-input-block">
                            <input type="text" name="version" required lay-verify="required" value="<?php echo htmlspecialchars($software['version']); ?>" placeholder="Enter Software Version" autocomplete="off" class="layui-input transparent-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">首页简介</label>
                        <div class="layui-input-block">
                            <textarea name="concise" required lay-verify="required" placeholder="Enter Software Concise" class="layui-textarea transparent-input"><?php echo htmlspecialchars($software['concise']); ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">详细</label>
                        <div class="layui-input-block">
                            <textarea name="details" required lay-verify="required" placeholder="Enter Software Details" class="layui-textarea transparent-input"><?php echo htmlspecialchars($software['details']); ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">更新内容</label>
                        <div class="layui-input-block">
                            <textarea name="update_info" required lay-verify="required" placeholder="Enter Update Info" class="layui-textarea transparent-input"><?php echo htmlspecialchars($software['update_info']); ?></textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Icon</label>
                        <div class="layui-input-block">
                            <input type="file" name="icon" accept="image/*">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">Images</label>
                        <div class="layui-input-block">
                            <input type="file" name="images[]" multiple accept="image/*">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">上传软件文件</label>
                        <div class="layui-input-block">
                            <input type="file" name="file" accept=".exe,.zip,.rar,.7z">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn layui-btn-radius" lay-submit lay-filter="formDemo">更新软件</button>
                        </div>
                    </div>
                </form>
                <h3>Current Images</h3>
                <div class="images-preview">
                    <?php foreach ($images as $image): ?>
                        <img src="<?php echo $image['image_path']; ?>" onclick="showImage('<?php echo $image['image_path']; ?>')" alt="Image">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

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
<?php include 'footer.php'; ?>