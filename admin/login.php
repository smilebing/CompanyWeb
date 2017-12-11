<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/20
 * Time: 23:00
 */
?>

<?php
require '../dbConfig.php';
header('Content-type:text/json');
session_start();

if(isset($_POST['username']) && isset($_POST['password'])) {

//获取用户名和密码
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

////面向对象方式
    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);

//判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' =>mysqli_connect_error() );
        echo json_encode($arr);
        exit;
    }
    $mysqli->set_charset("utf8");


    $query = "SELECT  username  FROM users WHERE (username = ?) and (pwd = ?)";
    $stmt = $mysqli->stmt_init();

    if ($stmt->prepare($query)) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->bind_result($name);
        $success=false;
        while ($stmt->fetch()) {
            $success=true;
            break;
        }

        if ($success) {
            //用户存在
            $_SESSION['user_account'] = $username;
            $arr = array('result' => true);
            echo json_encode($arr);
            $stmt->close();
            $mysqli->close();
            exit;
        }
        else{
            $arr = array('result' => false, 'msg' =>'用户名或者密码错误' );
            echo json_encode($arr);
            $stmt->close();
            $mysqli->close();
            exit;
        }
    }
    $arr = array('result' => false, 'msg' =>'用户名或者密码错误' );
    echo json_encode($arr);
    $stmt->close();
    $mysqli->close();
    exit;
}
else if(isset($_POST['action']))
{
    $action = trim($_POST['action']);
    //退出登录
    session_destroy();

    $arr = array('result' => true);
    echo json_encode($arr);}
?>
