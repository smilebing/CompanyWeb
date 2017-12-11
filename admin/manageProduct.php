<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/22
 * Time: 15:13
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
//删除产品
if (isset($_POST['delProductId'])) {
    $delProductId = trim($_POST['delProductId']);

    require '../dbConfig.php';
    header('Content-type:text/json');

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
    //判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' => mysqli_connect_error());
        echo json_encode($arr);
        exit;
    }

    $delSql = "delete from product where id=?";
    //获得预处理对象
    $delStmt = $mysqli->prepare($delSql);
    //绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $delStmt->bind_param("s", $delProductId);//绑定时使用变量绑定
    //执行预处理
    $result = $delStmt->execute();

    if ($delStmt->affected_rows > 0) {
        //成功
        $arr = array('result' => true, 'msg' => '删除成功');
        echo json_encode($arr);
        $delStmt->close();
        $mysqli->close();
        exit();
    } else {
        $arr = array('result' => false, 'msg' => '删除失败');
        echo json_encode($arr);
        $delStmt->close();
        $mysqli->close();
        exit();
    }
}
?>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <span>现有产品</span>
        <button class="btn btn-success" onclick="jumpToAddProduct()">添加产品</button>
    </div>
    <!-- Table -->
    <table class="table table-striped">
        <thead>
        <td>序号</td>
        <td>产品名称</td>
        <td>类别</td>
        <td>显示序号</td>
        <td>操作</td>
        </thead>

        <tbody>

        <?php
        //当前查看的页数
        $pageIndex = 1;
        $pageSize = 12;
        if (isset($_GET['pageIndex'])) {
            $pageIndex = $_GET['pageIndex'] > 0 ? $_GET['pageIndex'] : $pageIndex;
        }

        //查询数据库中产品类型
        require '../dbConfig.php';
        $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
        //判断是否连接成功
        if (!$mysqli) {
            $arr = array('result' => false, 'msg' => mysqli_connect_error());
            echo json_encode($arr);
            exit;
        }

        //查找所有产品数量
        $sql = "SELECT
                    count(*) sumCount
                FROM
                    product";
        $result = $mysqli->query($sql);
        $sumCount = 0;
        while ($row = $result->fetch_assoc()) {
            $sumCount = $row['sumCount'];
            break;
        }

        //select * from table limit (start-1)*limit,limit
        $sqlPageIndex = ($pageIndex-1) * 12;

        if ($sumCount > 0) {
            $sql = "SELECT
                        product.*, producttype.`name` typeName
                    FROM
                        product
                    LEFT JOIN producttype ON product.productType = producttype.id
                    ORDER BY
                        product.productType,
                    
                    IF (
                        isnull(product.orderNum),
                        1,
                        0
                    ),
                     product.orderNum
                    LIMIT ?,
                     ?";

            $stmt = $mysqli->prepare($sql);
//绑定参数 第一个参数为绑定的数据类型
            /*
            i:integer 整型
            d:double 浮点型
            s:string 字符串
            b:a blob packets blob数据包
            */
            $stmt->bind_param("ii", $sqlPageIndex, $pageSize);//绑定时使用变量绑定
//执行预处理
            $stmt->execute();
            $stmt->bind_result($id, $name, $description, $productType, $imgPath, $showInIndex, $orderNum, $typeName);

            $id = 0;
            $name = '';
            $index = 1;

                //获取数据
                while ($stmt->fetch()) {
                    //输出表单
                    echo '<tr>';
                    echo '<td>' . $index . '</td>';
                    echo '<td>' . $name . '</td>';
                    echo '<td>' . $typeName . '</td>';
                    echo '<td>'.$orderNum.'</td>';
                    echo '<td>';
                    echo '<button class="btn btn-warning" onclick="editProduct(' . $id . ')">修改</button>&nbsp&nbsp';
                    echo '<button class="btn btn-danger" onclick="delProduct(' . $id . ')">删除</button></td>';
                    echo '</tr>';
                    $index++;
                }

        }


        $mysqli->close();
        ?>
        </tbody>
    </table>
</div>
<ul class="pager">
    <?php
    $sumPage = ceil($sumCount / 12);
    $currentPageIndex = $pageIndex;
    if ($currentPageIndex > 1) {
        $parm = "goto('manageProduct.php',{'pageIndex':" . ($currentPageIndex - 1) . "})";
        echo '<li class="previous"><a href="javascript:;" onclick="' . $parm . '">&larr; 上一页</a></li>';
    }

    echo '<li class="">第' . $currentPageIndex . ' 页/共' . $sumPage . '页</li>';

    if ($sumPage > $currentPageIndex) {
        $parm = "goto('manageProduct.php',{'pageIndex':" . ($currentPageIndex + 1) . "})";
        echo '<li class="next"><a href="javascript:;" onclick="' . $parm . '">下一页 &rarr;</a></li>';
    }
    ?>
</ul>

<script>
    function delProduct(id) {
        swal({
            title: '警告',
            text: '是否要删除',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: "确定",
            cancelButtonText: "取消",
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.post('manageProduct.php', {'delProductId': id}, function (data) {
                    if (data.result) {
                        swal({
                            text: '删除成功',
                            type: 'success',
                            timer: 3000
                        }).then(function () {
                            goto('manageProduct.php');
                        });
                    } else {
                        swal({
                            text: '删除失败',
                            type: 'error',
                            timer: 3000
                        });
                    }
                });
            }
        }).catch(swal.noop);
    }

    function jumpToAddProduct() {
        goto('editProduct.php');
    }

    function editProduct(id)
    {
        $.get('editProduct.php',{'productId':id},function (data) {
            $('#Main').html(data);
        });
    }
</script>
