<?php 
/**
 * 后台核心文件
 * BY：云猫
 * CC的小窝
 */
include 'header.php'; ?>


    <div class="layui-row">
        <div class="content-box">
            <center>
            <h2>欢迎来到小猫咪程序后台面板</h2>
            
            <?php
include 'version.php';
$url = "https://lwcat.cn/software/update.php";$ch = curl_init($url);

// 设置cURL选项，忽略SSL证书验证
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);$response = curl_exec($ch);$status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($status_code == 200) {
    $json = json_decode($response, true);
    if ($json['version'] ==$version) {
        echo "当前版本".$version."<br>最新版本：".$json['version']."<br>当前已是最新版本";
    } else {
        echo "当前版本：".$version."<br>最新版本：".$json['version']."<br>有新版本哦，请参考更新内容来考虑是否更新<br>本次更新内容：<br>".$json['new']."<br><a class='btn btn-primary' href='".$json['url']."'>下载最新版本</a>";
    }
} else {
    echo "请求服务器失败，请联系作者";
}
?>
</center>
        </div>
    </div>

<?php include 'footer.php'; ?>
