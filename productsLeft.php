<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/21
 * Time: 22:45
 */
?>

<div style="width: 20%;float: left">
    <div class="panel panel-default">
        <div class="panel-heading">
            <label style="font-size: 16px">Products</label>
        </div>
        <table class="table table-hover">
            <tr>
                <td><a href="javascript:;" onclick="showHashProducts(0)">All Products</a><br></td>
            </tr>

            <?php
            require 'dbConfig.php';
            //查找数据库 FAQ数据
            $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
            //判断是否连接成功
            if (!$mysqli) {
                echo mysqli_connect_error();
                exit;
            }

            $sql = "SELECT
                            *
                        FROM
                            producttype
                        ORDER BY
                            `name`";

            $result = $mysqli->query($sql);

            $id = 0;
            $name = '';

            if ($result->num_rows > 0) {
                //获取数据
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                    echo '<tr><td><a href="javascript:;" onclick="showHashProducts(' . $id . ')">' . $name . '</a></td></tr>';
                }
            }
            $mysqli->close();
            ?>
        </table>
    </div>
</div>

<div id="productRightDiv" style="width: 78%;float: right;margin-right: 5px">



