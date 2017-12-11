<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/20
 * Time: 19:28
 */
?>

<style>
    .navbar-default .navbar-nav > li > a:hover {
        background-color: #265a88;
        color: white;
    }

    .navbar-default .navbar-nav > li > a {
        color: white;
        border-right: 1px solid white;
        font-size: 16px;
    }

    .nav > li:hover .dropdown-menu {
        display: block;
    }

    .navbar-default .navbar-collapse, .navbar-default .navbar-form
    {
        padding-left: 0px;
    }

    .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover
    {
        background-color:#265a88 ;
        color: white;
    }

    .dropdown-menu a
    {
        font-size: 15px;
    }
    
</style>

<div>
    <div class="center-block" style="width:970px;">
        <img src="img/logo2.png">
    </div>

    <!-- banner begin-->
    <div>
        <nav class="navbar navbar-default center-block" style="background-color: #1b86e4">
            <div class="container-fluid" style="padding-left: 0px">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="rightWhiteBorder"><a href="javascript:;" onclick="changeHash('index')" style="color: white;">&nbsp&nbsp Home &nbsp<span
                                        class="sr-only"></span></a></li>
                        <li class="rightWhiteBorder"><a href="javascript:;" style="color: white"
                                                        onclick="changeHash('aboutUs')"> About Us</a></li>
                        <li class="dropdown">
                            <a href="javascript:;" onclick='showHashProducts(0)' class="dropdown-toggle"
                               data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false"> Products <span class="caret"></span></a>
                            <ul class="dropdown-menu">

                                <?php
                                //查找数据库中产品类型
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
                                            producttype.name";

                                $result= $mysqli->query($sql);

                                echo '<li><a href="javascript:;" onclick="showHashProducts(0)">All Products</a></li>';

                                if ($result->num_rows > 0) {
                                    //获取数据
                                    while ($row = $result->fetch_assoc()) {
                                        $id=$row['id'];
                                        $name= $row['name'];
                                        echo '<li><a href="javascript:;" onclick="showHashProducts('.$id.')">'.$name.'</a></li>';
                                    }
                                }
                                $mysqli->close();
                                ?>
                            </ul>
                        </li>
                        <li class="rightWhiteBorder"><a href="javascript:;" style="color:white;"
                                                        onclick='changeHash("culture")'> Culture </a></li>
                        <li class="rightWhiteBorder"><a href="javascript:;" style="color:white;"
                                                        onclick="changeHash('service')"> Service </a></li>
                        <li class="rightWhiteBorder"><a href="javascript:;" style="color:white;"
                                                        onclick='changeHash("contactUs")'> Contact Us </a></li>

                    </ul>
                    <form class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" id="searchName" class="form-control" placeholder="Product">
                        </div>
                        <a onclick="searchProductByHash()" class="btn btn-default">Search</a>
                    </form>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>
<!-- banner end -->


