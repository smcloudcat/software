<?php
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
include 'header.php';

$stmt = $pdo->query('SELECT * FROM software');
$softwares = $stmt->fetchAll();
?>


    <div class="layui-row">
        <div class="content-boxmanage">
            <h2>管理软件</h2>
            <table class="layui-table transparent-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>软件名称</th>
                        <th>版本号</th>
                        <th>下载次数</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($softwares as $software): ?>
                        <tr>
                            <td><?php echo $software['id']; ?></td>
                            <td><?php echo htmlspecialchars($software['name']); ?></td>
                            <td><?php echo htmlspecialchars($software['version']); ?></td>
                            <td><?php echo $software['download_count']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $software['id']; ?>" class="layui-btn layui-btn-xs">编辑</a>
                                <a href="delete.php?id=<?php echo $software['id']; ?>" class="layui-btn layui-btn-danger layui-btn-xs">删除</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


<?php include 'footer.php'; ?>
