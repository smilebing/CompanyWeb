<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/21
 * Time: 11:40
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
if (isset($_POST['oldpassword']) && isset($_POST['newpassword'])) {
    //修改密码
    require '../dbConfig.php';
    header('Content-type:text/json');
    $username = $_SESSION['user_account'];
    $oldPassword = trim($_POST['oldpassword']);
    $newPassword = trim($_POST['newpassword']);

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
    //判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' =>mysqli_connect_error() );
        echo json_encode($arr);
        exit;
    }

    $sql = "SELECT username FROM users WHERE username= ? AND pwd= ?";
    //获得预处理对象
    $stmt = $mysqli->prepare($sql);
    //绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $stmt->bind_param('ss', $username,$oldPassword);//绑定时使用变量绑定
//执行预处理
    $stmt->execute();

    $stmt->bind_result($name);
    $success=false;
    while ($stmt->fetch()) {
        $success=true;
        break;
    }
    $stmt->close();
    $mysqli->close();

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
    //判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' =>mysqli_connect_error() );
        echo json_encode($arr);
        exit;
    }
    //行数
    if ($success > 0) {
        //用户存在
        //更新数据库
        $updateSql = "UPDATE users SET pwd=? WHERE username =?";
        //获得预处理对象
        //绑定参数 第一个参数为绑定的数据类型
        /*
        i:integer 整型
        d:double 浮点型
        s:string 字符串
        b:a blob packets blob数据包
        */
        $updateStmt = $mysqli->prepare($updateSql);
        $updateStmt->bind_param('ss', $newPassword,$username);//绑定时使用变量绑定

        //执行预处理

        if ($updateStmt->execute()) {
            //更新成功
            $arr = array('result' => true);
            echo json_encode($arr);
            //退出登录
            session_destroy();

        } else {
            $arr = array('result' => false, 'msg' => '更新失败');
            echo json_encode($arr);
        }
        $updateStmt->close();
    } else {
        $arr = array('result' => false, 'msg' => '密码不正确');
        echo json_encode($arr);
    }

    exit;
}
?>


<div class="userInfo" style="width: 300px">
    <h3>修改密码</h3>
    <div class="form-group">
        <label for="name">请输入旧密码</label>
        <input type="text" class="form-control" id="oldpassword" placeholder="旧密码">
        <label for="name">请输入新密码</label>
        <input type="password" class="form-control" id="newpassword" placeholder="新密码">
        <label for="name">请再次输入新密码</label>
        <input type="password" class="form-control" id="newpassword2" placeholder="再次输入新密码">
    </div>
    <button class="btn btn-default" onclick="changePwd()">修改</button>
</div>

<script>
    function changePwd() {
        var oldpwd=$('#oldpassword').val().trim();
        var newpwd=$('#newpassword').val().trim();
        var newpwd2=$('#newpassword2').val().trim();

        if(newpwd!=newpwd2)
        {
            swal({
               text:'两次新密码不一致',
                type:'error',
                timer:3000
            });
            return;
        }

        $.post('userInfo.php',{'oldpassword':oldpwd,'newpassword':newpwd},function (data)
        {
            console.log(data);
            if(data.result)
            {
                swal({
                    text:'密码修改成功',
                    type:'success',
                    timer:3000,
                }).then(function(){
                    window.location.href='index.php';
                });
            }
            else {
                swal({
                    title:'修改失败',
                    text:data.msg,
                    type:'error',
                    timer:3000
                });
            }
        });
    }
</script>
