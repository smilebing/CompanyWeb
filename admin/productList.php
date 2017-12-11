<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/21
 * Time: 23:46
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
//添加产品类型
if (isset($_POST['productType'])) {
    $type = trim($_POST['productType']);
    require '../dbConfig.php';
    header('Content-type:text/json');

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
    //判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' => mysqli_connect_error());
        echo json_encode($arr);
        exit;
    }

    $insertSql = "insert into producttype (name) values(?)";
    //获得预处理对象
    $updateStmt = $mysqli->prepare($insertSql);
    //绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $updateStmt->bind_param("s", $type);//绑定时使用变量绑定
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

<?php
if (isset($_POST['typeId'])) {
    //删除类别
    $typeId = trim($_POST['typeId']);

    require '../dbConfig.php';
    header('Content-type:text/json');

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
    //判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' => mysqli_connect_error());
        echo json_encode($arr);
        exit;
    }

    $delSql = "delete from producttype where id=?";
    //获得预处理对象
    $delStmt = $mysqli->prepare($delSql);
    //绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $delStmt->bind_param("s", $typeId);//绑定时使用变量绑定
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

<?php
//更新类别

if (isset($_POST['updateId']) && isset($_POST['name'])) {
    require '../dbConfig.php';
    header('Content-type:text/json');

    $id = trim($_POST['updateId']);
    $name = trim($_POST['name']);

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
//判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' => mysqli_connect_error());
        echo json_encode($arr);
        exit;
    }

    $updateSql = "update producttype  set name=? where id=?";
//获得预处理对象
    $updateStmt = $mysqli->prepare($updateSql);
//绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $updateStmt->bind_param("si", $name,$id);//绑定时使用变量绑定
//执行预处理
    $result = $updateStmt->execute();

    if ($updateStmt->affected_rows > 0) {
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
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <span>添加产品类型</span>
    </div>
    <div class="panel-body">
        <span>类型名称</span>
        <input class="form-control" id="typeInput">
        <button class="btn btn-success" style="float: right;margin-top: 4px" onclick="addType()">添加</button>
    </div>
</div>


<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <span>现有产品类型</span>
    </div>
    <!-- Table -->
    <table class="table table-striped">
        <thead>
        <td>序号</td>
        <td>产品类型</td>
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
                    producttype";
        $result = $mysqli->query($sql);
        $sumCount = 0;
        while ($row = $result->fetch_assoc()) {
            $sumCount = $row['sumCount'];
            break;
        }


        //select * from table limit (start-1)*limit,limit
        $sqlPageIndex = ($pageIndex - 1) * 12;

        if ($sumCount > 0) {
            $sql = "SELECT
                            *
                        FROM
                            producttype
                            ORDER BY
                        `name`
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
            $stmt->bind_result($id, $name, $orderNum);

            $id = 0;
            $name = '';
            $index = 1;

                //获取数据
        while ($stmt->fetch()) {
                    //输出表单
                    echo '<tr>';
                    echo '<td>' . $index . '</td>';
                    echo '<td>';
                    echo $name;
                    echo '</td>';
                    echo '<td>';
                    echo '<button class="btn btn-warning" onclick="editProductType(' . $id . ')">修改</button>&nbsp&nbsp';
                    echo '<button class="btn btn-danger" onclick="delProductType(' . $id . ')">删除</button></td>';
                    echo '</tr>';
                    $index++;
                }

            $stmt->close();
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
        $parm = "goto('productList.php',{'pageIndex':" . ($currentPageIndex - 1) . "})";
        echo '<li class="previous"><a href="javascript:;" onclick="' . $parm . '">&larr; 上一页</a></li>';
    }

    echo '<li class="">第' . $currentPageIndex . ' 页/共' . $sumPage . '页</li>';

    if ($sumPage > $currentPageIndex) {
        $parm = "goto('productList.php',{'pageIndex':" . ($currentPageIndex + 1) . "})";
        echo '<li class="next"><a href="javascript:;" onclick="' . $parm . '">下一页 &rarr;</a></li>';
    }
    ?>
</ul>

<script type="text/javascript">
    function addType() {
        var type = $('#typeInput').val().trim();
        if (type.length == 0) {
            swal({
                text: '请输入产品类型',
                type: 'error',
                timer: 3000
            });
            return;
        }

        $.post('productList.php', {'productType': type}, function (data) {
            if (data.result) {
                swal({
                    text: '保存成功',
                    type: 'success',
                    timer: 3000
                }).then(function () {
                    goto('productList.php');
                });
            }
        });
    }

    function delProductType(typeId) {
        var id = typeId;
        swal({
            title: '警告',
            text: '是否要删除',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: "确定",
            cancelButtonText: "取消",
        }).then(function (isConfirm) {
            if (isConfirm) {
                $.post('productList.php', {'typeId': id}, function (data) {
                    if (data.result) {
                        swal({
                            text: '删除成功',
                            type: 'success',
                            timer: 3000
                        }).then(function () {
                            goto('productList.php');
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

    function editProductType(typeId) {
        swal({
            title: '提示',
            text: '请输入新的产品类型名称',
            type: 'warning',
            input: 'text',
            showCancelButton: true,
            confirmButtonText: "确定",
            cancelButtonText: "取消",
        }).then(function (input) {
            $.post('productList.php', {'updateId': typeId, 'name': input}, function (data) {
                if (data.result) {
                    swal({
                        text: '修改成功',
                        type: 'success',
                        timer: 3000
                    }).then(function () {
                        goto('productList.php');
                    });
                }
                else {
                    swal({
                        text: '修改失败',
                        type: 'error',
                        timer: 3000
                    });
                }
            });
        }).catch(swal.noop);
    }
</script>