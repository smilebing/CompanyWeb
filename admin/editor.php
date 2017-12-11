<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/21
 * Time: 15:09
 */
?>

<?php
session_start();
if (isset($_SESSION['user_account'])) {
    $username = $_SESSION['user_account'];
} else {
    header('Location:Home.php');
    exit;
}
?>

<div>

    <?php
    require '../dbConfig.php';
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
        //判断是否连接成功
        if (!$mysqli) {
            echo json_encode('数据库连接失败');
            exit;
        }

        $sql = "select * from article where type='faq'";


        switch ($action) {
            case 'promotions':
                $sql = "select * from article where articleType='promotions' limit 1";
                break;
            case 'aboutus':
                $sql = "select * from article where articleType='aboutus' limit 1";
                break;
            case 'contactus':
                $sql = "select * from article where articleType='contactus' limit 1";
                break;
            case 'culture':
                $sql = "select * from article where articleType='culture' limit 1";
                break;
            case 'service':
                $sql = "select * from article where articleType='service' limit 1";
                break;
        }
        $result = $mysqli->query($sql);

        $content='';
        $id=1;
        if ($result->num_rows > 0) {
            //移动记录指针
            //$result->data_seek(1);//0 为重置指针到起始
            //获取数据
            while ($row = $result->fetch_assoc()) {
                $id= $row['id'];
                $content= $row['content'];
            }
        }
        $mysqli->close();
    }
    ?>

    <input type="hidden" id="id" value="<?php echo $id ?>">

    <?php
    switch ($action) {
        case 'promotions':
            echo '<span style="font-size: 30px;">修改Promotions页面</span>';
            break;
        case 'aboutus':
            echo '<span style="font-size: 30px;">修改About Us页面</span>';
            break;
        case 'contactus':
            echo '<span style="font-size: 30px;">修改Contact Us页面</span>';
            break;
        case 'culture':
            echo '<span style="font-size: 30px;">修改Culture页面</span>';
            break;
        case 'service':
            echo '<span style="font-size: 30px;">修改Service页面</span>';
            break;
    }
    ?>



    <button class="btn btn-primary" onclick="saveEditorContent()" style="text-align: right">保存</button>

    <!-- 加载编辑器的容器 -->
    <script id="editor" name="content" type="text/plain" style="width: 1024px;height: 600px"><?php echo $content; ?></script>


    </div>

    <script type = "text/javascript" >

    function isFocus(e) {
        alert(UE.getEditor('editor').isFocus());
        UE.dom.domUtils.preventDefault(e)
    }

    function setblur(e) {
        UE.getEditor('editor').blur();
        UE.dom.domUtils.preventDefault(e)
    }

    function insertHtml() {
        var value = prompt('插入html代码', '');
        UE.getEditor('editor').execCommand('insertHtml', value)
    }

    function createEditor() {
        enableBtn();
        UE.getEditor('editor');
    }

    function getAllHtml() {
        alert(UE.getEditor('editor').getAllHtml())
    }

    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getContent());
        alert(arr.join("\n"));
    }

    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UE.getEditor('editor').getPlainTxt());
        alert(arr.join('\n'))
    }

    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用ueditor')方法可以设置编辑器的内容");
        UE.getEditor('editor').setContent('欢迎使用ueditor', isAppendTo);
        alert(arr.join("\n"));
    }

    function setDisabled() {
        UE.getEditor('editor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UE.getEditor('editor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UE.getEditor('editor').selection.getRange();
        range.select();
        var txt = UE.getEditor('editor').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UE.getEditor('editor').getContentTxt());
        alert(arr.join("\n"));
    }

    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UE.getEditor('editor').hasContents());
        alert(arr.join("\n"));
    }

    function setFocus() {
        UE.getEditor('editor').focus();
    }

    function deleteEditor() {
        disableBtn();
        UE.getEditor('editor').destroy();
    }

    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }

    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = UE.dom.domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            UE.dom.domUtils.removeAttributes(btn, ["disabled"]);
        }
    }

    function getLocalData() {
        alert(UE.getEditor('editor').execCommand("getlocaldata"));
    }

    function clearLocalData() {
        UE.getEditor('editor').execCommand("clearlocaldata");
        alert("已清空草稿箱")
    }
    </script>
