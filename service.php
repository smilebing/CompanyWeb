<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/22
 * Time: 10:36
 */
?>

<div class="center-block">
    <!--    left div-->
    <div style="width:70%;float: left">
        <div>
            <?php
            require 'dbConfig.php';
            //查找数据库 FAQ数据
            $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
            //判断是否连接成功
            if (!$mysqli) {
                echo mysqli_connect_error();
                exit;
            }

            $sql = "select * from article where articleType='service' limit 1";

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

        <!--left div end-->

    </div>

    <?php require 'rightBar.php'?>
