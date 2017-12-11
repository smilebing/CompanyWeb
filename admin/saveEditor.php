<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/21
 * Time: 19:03
 */
?>

<?php
session_start();
if (!isset($_SESSION['user_account'])) {
    header('Location:Home.php');
    exit;
}
?>

<?php
if (isset($_POST['id']) && isset($_POST['content'])) {
    $id = $_POST['id'];
    $content = $_POST['content'];

    require '../dbConfig.php';
    header('Content-type:text/json');

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
    //判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' => mysqli_connect_error());
        echo json_encode($arr);
        exit;
    }

    $updateSql = "update article set content= ? where id= ?";
    //获得预处理对象
    $updateStmt = $mysqli->prepare($updateSql);
    //绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $updateStmt->bind_param("si", $content, $id);//绑定时使用变量绑定
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
if (isset($_POST['mainid']) && isset($_POST['maincontent'])) {
    $id = $_POST['mainid'];
    $content = $_POST['maincontent'];

    require '../dbConfig.php';
    header('Content-type:text/json');

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
//判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' => mysqli_connect_error());
        echo json_encode($arr);
        exit;
    }

    $updateSql = "UPDATE article SET content= ? WHERE id= ?";
//获得预处理对象
    $updateStmt = $mysqli->prepare($updateSql);
//绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $updateStmt->bind_param("si", $content, $id);//绑定时使用变量绑定
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