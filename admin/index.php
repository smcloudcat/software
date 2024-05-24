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
            <h2>欢迎来到小猫咪程序后台面板</h2><br>
<div id="zysx">Hello World</div>
</center>
        </div>
    </div>
<script>
$(document).ready(function() {
    function fetchSentence() {
        $.getJSON("<?php echo $xiao;?>", function(data) {
            if(data.code === 1) {
               document.getElementById("zysx").innerHTML = (data.result);
            } else {
                document.getElementById("zysx").innerHTML = ("(╥_╥) 获取失败");
            }
        })
        .fail(function() {
            document.getElementById("zysx").innerHTML = ("(╥_╥) 请求失败");
        });
    }

    fetchSentence();

    $('#convertButton').click(function() {
        fetchSentence();
    });
        $('#copyButton').click(function() {
        fetchSentence();
    });
});
</script> 
<?php include 'footer.php'; ?>
