<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/22
 * Time: 16:59
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

<?php
//$.post('editProduct.php',{'name':name,'description':description,'productType':productType},function (data) {
if(isset($_POST['id'])&&isset($_POST['productName'])&&isset($_POST['imgPath'])&&isset($_POST['content'])&&isset($_POST['productType'])&&isset($_POST['showInIndex'])&&isset($_POST['orderNum']))
{
    //修改产品
    require '../dbConfig.php';
    header('Content-type:text/json');

    $id=trim($_POST['id']);
    $productName=trim($_POST['productName']);
    $imgPath=trim($_POST['imgPath']);
    $content=trim($_POST['content']);
    $type=trim($_POST['productType']);
    $showInIndex=trim($_POST['showInIndex']);
    $orderNum=trim($_POST['orderNum']);

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
//判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' => mysqli_connect_error());
        echo json_encode($arr);
        exit;
    }

    $updateSql = "UPDATE product
SET `name` = ?,
 description = ?,
 imgPath = ?,
 productType = ?,
 showInIndex=?,
 orderNum=?
WHERE
	id = ?";
//获得预处理对象
    $updateStmt = $mysqli->prepare($updateSql);
//绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $updateStmt->bind_param("sssiiii", $productName,$content,$imgPath,$type,$showInIndex,$orderNum,$id);//绑定时使用变量绑定
//执行预处理
    $result = $updateStmt->execute();

    if ($result) {
        //成功
        $arr = array('result' => true, 'msg' => '修改成功');
        echo json_encode($arr);
        $updateStmt->close();
        $mysqli->close();
        exit();
    } else {
        $arr = array('result' => false, 'msg' => '修改失败');
        echo json_encode($arr);
        $updateStmt->close();
        $mysqli->close();
        exit();
    }

}
else if(isset($_POST['productName'])&&isset($_POST['imgPath'])&&isset($_POST['content'])&&isset($_POST['productType'])&&isset($_POST['showInIndex'])&&isset($_POST['orderNum'])){
    //添加产品
    require '../dbConfig.php';
    header('Content-type:text/json');

    $productName=trim($_POST['productName']);
    $imgPath=trim($_POST['imgPath']);
    $content=trim($_POST['content']);
    $type=trim($_POST['productType']);
    $showInIndex=trim($_POST['showInIndex']);
    $orderNum=trim($_POST['orderNum']);

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
//判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' => mysqli_connect_error());
        echo json_encode($arr);
        exit;
    }

    $updateSql = "INSERT INTO product (
	`name`,
	description,
	imgPath,
	productType,
	showInIndex,
	orderNum
)
VALUES
	(?, ?, ?,?, ?,?);";
//获得预处理对象
    $updateStmt = $mysqli->prepare($updateSql);
//绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $updateStmt->bind_param("sssiii", $productName,$content,$imgPath,$type,$showInIndex,$orderNum);//绑定时使用变量绑定
//执行预处理
    $result = $updateStmt->execute();

    if ($result) {
        //成功
        $arr = array('result' => true, 'msg' => '保存成功');
        echo json_encode($arr);
        $updateStmt->close();
        $mysqli->close();
        exit();
    } else {
        $arr = array('result' => false, 'msg' => '保存失败');
        echo json_encode($arr);
        $updateStmt->close();
        $mysqli->close();
        exit();
    }
}

?>




<div class="panel panel-default">
    <div class="panel-heading">

        <?php
        $isAdd=true;

        $selectProductName='';
        $selectProductDesc='';
        $selectProductType=0;
        $selectProductImgPath='';
        $selectProductTypeName='';
        $selectShowInIndex=0;
        //查看某个产品
        if(isset($_GET['productId']))
        {
            $isAdd=false;
            $productId=$_GET['productId'];

            //产品id
            echo '<input type="hidden" id="productId" value="'.$productId.'">';
            echo ' <span>产品修改</span>
        <button class="btn btn-success" style="float: right;" onclick="saveProduct()">保存修改</button>';


            require '../dbConfig.php';
            $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
            //判断是否连接成功
            if (!$mysqli) {
                $arr = array('result' => false, 'msg' => mysqli_connect_error());
                echo json_encode($arr);
                exit;
            }

            //查询数据库中该产品信息
            $sql = "SELECT
	product.*, producttype.name typeName
FROM
	product
LEFT JOIN producttype ON product.productType = producttype.id
WHERE
	product.id = ?
ORDER BY
	product.productType";

            //获得预处理对象
            $stmt = $mysqli->prepare($sql);
//绑定参数 第一个参数为绑定的数据类型
            /*
            i:integer 整型
            d:double 浮点型
            s:string 字符串
            b:a blob packets blob数据包
            */
            $stmt->bind_param("i", $productId);//绑定时使用变量绑定
//执行预处理
            $stmt->execute();
            $stmt->bind_result($id, $name, $description, $productType, $imgPath, $showInIndex, $orderNum, $typeName);

            $hasProduct=false;

                while ($stmt->fetch()) {
                    $hasProduct = true;
                    $selectProductName = $name;
                    $selectProductDesc = $description;
                    $selectProductType = $productType;
                    $selectProductImgPath = $imgPath;
                    $selectProductTypeName = $typeName;
                    $selectShowInIndex=$showInIndex;
                    $selectOrderNum=$orderNum;
                    break;
                }
                if(!$hasProduct)
                {
                    echo '<label>没有找到该产品</label>';
                    exit();
                }
                $stmt->close();
                $mysqli->close();
        }
        else{
            echo ' <span>新增产品</span>
        <button class="btn btn-success" style="float: right;" onclick="addProduct()">保存</button>';
        }
        ?>

    </div>
    <div class="panel-body">
        <div class="form-control" style="height: 470px">
            <span>产品名称</span>

            <?php
            //产品名称
            echo '<input class="form-control" id="productNameInput" value="'.$selectProductName.'">'
            ?>
            <span>产品类别</span>

            <select class="form-control" id="productTypeSelect">
                <?php
                //查询数据库中产品类型
                require '../dbConfig.php';
                $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
                //判断是否连接成功
                if (!$mysqli) {
                    $arr = array('result' => false, 'msg' => mysqli_connect_error());
                    echo json_encode($arr);
                    exit;
                }

                $sql = "select * from producttype";

                $result = $mysqli->query($sql);

                if ($result->num_rows>0) {
                    //获取数据
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $name = $row['name'];

                        if($id==$selectProductType)
                        {
                            echo '<option value='.$id.' selected >' . $name . '</option>';
                        }
                        else{
                            //输出下拉
                            echo '<option value='.$id.'>' . $name . '</option>';
                        }

                    }
                }
                $mysqli->close();
                ?>
            </select><br>
            <span>产品序号（用于设置同类型产品之间显示的先后）</span>
            <input type="number" id="orderNum" class="form-control" value="<?php if(!empty($selectOrderNum)) echo $selectOrderNum; ?>">
            <span>是否在主页显示</span>
            <select class="form-control" id="showInIndex">
                <?php
                    if($selectShowInIndex)
                    {
                        echo '<option value="1" selected>是</option>';
                        echo '<option value="0">否</option>';
                    }
                    else
                    {
                        echo '<option value="0" selected>否</option>';
                        echo '<option value="1" >是</option>';
                    }
                ?>
            </select>
            <br><span>产品预览图片</span>

            <button type="button" id="j_upload_img_btn">图片上传</button>
            <ul id="upload_img_wrap">
                <?php
                if(!$isAdd)
                {
                    if(empty($selectProductImgPath))
                    {
                        $selectProductImgPath='';
                    }
                    echo '<img id="productShowImg" src="'.$selectProductImgPath.'" height="150px">';
                    echo '<input id="imgPath" type="hidden" value="'.$selectProductImgPath.'">';

                }
                else{
                    echo '<input id="imgPath" type="hidden">';
                }
                ?>
            </ul>

            <!-- 加载编辑器的容器 -->
            <textarea id="uploadEditor" style="display: none;"></textarea>
        </div>
        <div class="form-control">
            <label class="center-block">产品描述</label>
        </div>
        <script id="editor" name="content" type="text/plain" style="width: 1024px;height: 600px"><?php echo $selectProductDesc; ?></script>

        </div>
</div>


<script>
        var editor = new UE.ui.Editor();
        editor.render('editor');

        // 实例化编辑器，这里注意配置项隐藏编辑器并禁用默认的基础功能。
        var uploadEditor = UE.getEditor("uploadEditor", {
            isShow: false,
            focus: false,
            enableAutoSave: false,
            autoSyncData: false,
            autoFloatEnabled:false,
            wordCount: false,
            sourceEditor: null,
            scaleEnabled:true,
            toolbars: [["insertimage", "attachment"]]
        });

        // 监听多图上传和上传附件组件的插入动作
        uploadEditor.ready(function () {
            uploadEditor.addListener("beforeInsertImage", _beforeInsertImage);
            //editor.addListener("afterUpfile",_afterUpfile);
        });

        // 自定义按钮绑定触发多图上传和上传附件对话框事件
        document.getElementById('j_upload_img_btn').onclick = function () {
            var dialog = uploadEditor.getDialog("insertimage");
            dialog.title = '多图上传';
            dialog.render();
            dialog.open();
        };



        // 多图上传动作
        function _beforeInsertImage(t, result) {
            var imageHtml = '';
            for(var i in result){
                imageHtml += '<img id="productShowImg" src="'+result[i].src+'" alt="'+result[i].alt+'" height="150px">';
                break;
            }
            $('#upload_img_wrap').html( imageHtml);
        }

        // 附件上传
//        function _afterUpfile(t, result) {
//            var fileHtml = '';
//            for(var i in result){
//                fileHtml += '<<a href="'+result[i].url+'" target="_blank">'+result[i].url+'</a>';
//                break;
//            }
//            document.getElementById('upload_file_wrap').innerHTML = fileHtml;
//        }


        function addProduct() {
            var productName=$('#productNameInput').val().trim();
            var imgPath=$('#productShowImg').attr('src');
            var content=UE.getEditor('editor').getContent();
            var type=$('#productTypeSelect').val();
            var showInIndex=$('#showInIndex').val();
            var orderNum=$('#orderNum').val();

            $.post('editProduct.php',{'productName':productName,'imgPath':imgPath,'content':content,'productType':type,'showInIndex':showInIndex,'orderNum':orderNum},function (data) {
                if (data.result) {
                    swal({
                        text: '添加成功',
                        type: 'success',
                        timer: 3000
                    }).then(function () {
                        goto('manageProduct.php');
                    });
                } else {
                    swal({
                        text: '添加失败',
                        type: 'error',
                        timer: 3000
                    });
                }
            });
        }

        function  saveProduct() {
            var imgPath=$('#productShowImg').attr('src');
        var content=UE.getEditor('editor').getContent();
        var type=$('#productTypeSelect').val();
            var productName=$('#productNameInput').val().trim();
        var id=$('#productId').val();
            var showInIndex=$('#showInIndex').val();
            var orderNum=$('#orderNum').val();

        $.post('editProduct.php',{'id':id,'productName':productName,'imgPath':imgPath,'content':content,'productType':type,'showInIndex':showInIndex,'orderNum':orderNum},function (data) {
            if (data.result) {
                swal({
                    text: '保存成功',
                    type: 'success',
                    timer: 3000
                }).then(function () {
                    goto('manageProduct.php');
                });
            } else {
                swal({
                    text: '保存失败',
                    type: 'error',
                    timer: 3000
                });
            }
        });
}
</script>