<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/20
 * Time: 20:14
 */?>

<?php
if(isset($_POST['name'])&& isset($_POST['email'])&&isset($_POST['message']))
{
    $name=trim($_POST['name']);
    $email=trim($_POST['email']);
    $message=trim($_POST['message']);

    require 'dbConfig.php';
    header('Content-type:text/json');

    if(empty($name)||empty($email)||empty($message))
    {
        $arr = array('result' => false, 'msg' =>'please input all' );
        echo json_encode($arr);
        exit;
    }

    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
    //判断是否连接成功
    if (!$mysqli) {
        $arr = array('result' => false, 'msg' =>mysqli_connect_error() );
        echo json_encode($arr);
        exit;
    }

    //插入数据库
    $sql='INSERT INTO contactus (NAME, email, message, isRead,createTime)
VALUES
	(
		?,
		?,
		?,
		FALSE,
		?
	)';

    //获得预处理对象
    $updateStmt = $mysqli->prepare($sql);
    //绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $createTime=date("Y-m-d H:i:s",time());
    $updateStmt->bind_param("ssss", $name,$email,$message,$createTime);//绑定时使用变量绑定
    //执行预处理
    $result = $updateStmt->execute();

    if ($result) {
        //成功
        $arr = array('result' => true, 'msg' => 'save success');
        echo json_encode($arr);
        $updateStmt->close();
        $mysqli->close();
        exit();
    } else {
        $arr = array('result' => false, 'msg' => 'save fail');
        echo json_encode($arr);
        $updateStmt->close();
        $mysqli->close();
        exit();
    }
exit();
}

?>


<div style="float: left;margin-left: 8%">
    <h2>
        <span style="color:rgb(13,102,194)">Contact Us</span>
    </h2>
        <div style="float:left">
        <div class="input-group" style="width:300px;">
            <span>Name</span>
            <input id="name" class="form-control">
            <br>
            <span>Email</span>
            <input id="email" class="form-control">
            <br>
            <span>Message</span>
            <textarea id="message" rows="10" style="width:300px;resize: none;" class="form-control"></textarea>
            <br>
            <button type="submit" class="btn btn-warning" style="margin-top: 10px" onclick="contactUs()">Submit</button>
        </div>
        </div>
        <div style="float: left; margin-left: 100px;margin-top: 15px;width: 400px;">
            <?php
            require 'dbConfig.php';
            //查找数据库 FAQ数据
            $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
            //判断是否连接成功
            if (!$mysqli) {
                echo mysqli_connect_error();
                exit;
            }

            $sql = "select * from article where articleType='contactus' limit 1";

            $result= $mysqli->query($sql);

            $content='';
            if ($result->num_rows > 0) {
                //获取数据
                while ($row = $result->fetch_assoc()) {
                    $content= $row['content'];
                }
            }
            $mysqli->close();
            echo $content;
            ?>
            </div>
</div>

<script>
function contactUs() {
    $name=$('#name').val().trim();
    $email=$('#email').val().trim();
    $message=$('#message').val().trim();

    if($name==''||$email==''||$message=='')
    {
        swal({
            title:'Warning',
            text:'Please input all',
            type:'error'
        });
        return;
    }

    swal({
        title: 'Tips',
        text: 'Send this message?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
    }).then(function (isConfirm) {
        if (isConfirm) {
            $.post('contactUs.php',{'name':$name,'email':$email,'message':$message},function(data)
            {
                if(data.result)
                {
                    swal({
                        text: "submit successfully",
                        type: "success",
                        timer: 3000
                    });

                    $('#name').val('');
                    $('#email').val('');
                    $('#message').val('');
                }
                else{
                    swal({
                        text: data.msg,
                        type: "error",
                        timer: 3000
                    });
                }
            });
        }
    }).catch(swal.noop);
}

</script>

