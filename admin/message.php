<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/30
 * Time: 23:01
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
//删除留言
if (isset($_POST['id'])) {
    $id = trim($_POST['id']);

    require '../dbConfig.php';
    header('Content-type:text/json');

    ////面向对象方式
    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);

//判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' => mysqli_connect_error());
        echo json_encode($arr);
        exit;
    }

    $delSql = "DELETE
FROM
	contactus
WHERE
	id = ?";
    //获得预处理对象
    $delStmt = $mysqli->prepare($delSql);
    //绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $delStmt->bind_param("s", $id);//绑定时使用变量绑定
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
        <span>留言</span>
    </div>
    <!-- Table -->
    <table class="table table-striped">
        <thead>
        <td>序号</td>
        <td>名字</td>
        <td>邮箱</td>
        <td>内容</td>
        <td>提交时间</td>
        <!--        <td>已经查看</td>-->
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

        //查找所有留言数量
        $sql = "SELECT
                    count(*) sumCount
                FROM
                    contactus";
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
                        contactus
                    ORDER BY
                        createTime DESC
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
            $stmt->bind_result($id, $name, $email, $message, $isRead, $createTime);

            $index = 1;
            while ($stmt->fetch()) {
                //输出表单
                echo '<tr>';
                echo '<td>' . htmlspecialchars($index, ENT_QUOTES, 'UTF-8', true) . '</td>';
                echo '<td width="10%">';
                echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8', true);
                echo '</td>';
                echo '<td width="15%">' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8', true) . '</td>';
                echo '<td width="40%">' . htmlspecialchars($message, ENT_QUOTES, 'UTF-8', true) . '</td>';
                echo '<td>' . $createTime . '</td>';
//                echo '<td>'.($isRead?'已查看':'未查看').'</td>';
                echo '<td>';
//                echo '<button class="btn btn-warning" onclick="editProductType(' . $id . ')">已查看</button>&nbsp&nbsp';
                echo '<button class="btn btn-danger" onclick="delMessage(' . $id . ')">删除</button></td>';
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
        $parm = "goto('message.php',{'pageIndex':" . ($currentPageIndex - 1) . "})";
        echo '<li class="previous"><a href="javascript:;" onclick="' . $parm . '">&larr; 上一页</a></li>';
    }

    echo '<li class="">第' . $currentPageIndex . ' 页/共' . $sumPage . '页</li>';

    if ($sumPage > $currentPageIndex) {
        $parm = "goto('message.php',{'pageIndex':" . ($currentPageIndex + 1) . "})";
        echo '<li class="next"><a href="javascript:;" onclick="' . $parm . '">下一页 &rarr;</a></li>';
    }
    ?>
</ul>
