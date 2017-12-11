<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/11/13
 * Time: 15:21
 */

?>

<div style="width: 70%; float: left">
    <div class="panel">
        <!--           产品-->
        <a href="javascript:;" onclick="showHashProducts(0)"> <img class="imgBorder" src="img/banner.jpg"
                                                                    style="width: auto; height: auto;max-width: 100%;max-height: 100%; "></a>
    </div>
</div>

<?php require 'rightPromotion.php' ?>

<div style="width: 100%;float: left">

    <div style="width: 33% ; float: left;border-right: 1px solid grey;padding-right: 2%;">
        <!--                    产品切换-->
        <label style="color:#2a5bb0;font-size: 18px">Products</label>

        <div id="myCarousel" class="carousel slide"
             style="border: 10px solid rgb(229, 229, 229);width: 300px;height: 190px">
            <!-- 轮播（Carousel）指标 -->
            <!--                        <ol class="carousel-indicators" style="bottom: 0px">-->
            <!--                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>-->
            <!--                            <li data-target="#myCarousel" data-slide-to="1"></li>-->
            <!--                            <li data-target="#myCarousel" data-slide-to="2"></li>-->
            <!--                        </ol>-->
            <!-- 轮播（Carousel）项目 -->
            <div class="carousel-inner full">

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
                                        product
                                    WHERE
                                        product.showInIndex = 1
                                    LIMIT 10";

                $result = $mysqli->query($sql);

                $first = true;
                if ($result->num_rows > 0) {
                    //获取数据
                    while ($row = $result->fetch_assoc()) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $imgPath = $row['imgPath'];
                        $productType=$row['productType'];

                        if (empty($imgPath) || $imgPath == '') {
                            $imgPath = 'img/no-image-available.jpg';
                        }

                        if ($first) {
                            echo '<div class="item active"  style="text-align:center">';
                            $first = false;
                        } else {
                            echo '<div class="item">';
                        }

                        echo '<a href="javascript:;" onclick="showHashProductDetail('.$id.','.$productType.')"><img class="lunboImg" src="' . $imgPath . '" alt="' . $name . '"></a>';
//                                    echo '<div  class="carousel-caption">' . $name . '</div>';
                        echo '</div>';
                    }
                }
                $mysqli->close();
                ?>

                <!--                                                        <div class="item active">-->
                <!--                                                            <img class="lunboImg" src="img/product.jpg" alt="First slide">-->
                <!--                                                            <div class="carousel-caption">标题 1</div>-->
                <!--                                                        </div>-->
                <!--                            <div class="item active">-->
                <!--                                <img class="lunboImg" src="img/product.jpg" alt="First slide">-->
                <!--                                <div class="carousel-caption">标题 1</div>-->
                <!--                            </div>-->
                <!--                            <div class="item">-->
                <!--                                <img class="lunboImg" src="img/product.jpg" alt="Second slide">-->
                <!--                                <div class="carousel-caption">标题 2</div>-->
                <!--                            </div>-->
                <!--                            <div class="item">-->
                <!--                                <img class="lunboImg" src="img/product.jpg" alt="Third slide">-->
                <!--                                <div class="carousel-caption">标题 3</div>-->
                <!--                            </div>-->
            </div>
            <!-- 轮播（Carousel）导航 -->
            <a class="carousel-control left" href="#myCarousel"
               data-slide="prev">&lsaquo;
            </a>
            <a class="carousel-control right" href="#myCarousel"
               data-slide="next">&rsaquo;
            </a>
        </div>

        <div>
            <?php
            //查找联系方式
            require 'dbConfig.php';
            //查找数据库 FAQ数据
            $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
            //判断是否连接成功
            if (!$mysqli) {
                echo mysqli_connect_error();
                exit;
            }

            $sql = "select * from article where articleType='mainProducts' limit 1";

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
        <div>
            <a href="javascript:;">
                <a href="javascript:;" onclick="changeHash('products')"><img style="float: right;"
                                                                           src="img/btn_learn.png"></a>
            </a>
        </div>

    </div>



    <div style="width: 33% ; float: left;border-right: 1px solid grey;padding-right: 1%;padding-left: 1%">
        <!--关于-->
        <div style="float: right;">
            <div>
                <label style="color:#2a5bb0;font-size: 18px">About Us</label>
                <img class="imgBorder" src="img/aboutus.jpg">
            </div>
            <div>
                <?php
                //查找关于我们
                require 'dbConfig.php';
                //查找数据库 FAQ数据
                $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
                //判断是否连接成功
                if (!$mysqli) {
                    echo mysqli_connect_error();
                    exit;
                }

                $sql = "select * from article where articleType='mainAboutUs' limit 1";

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
        <div>
            <a href="javascript:;">
                <a href="javascript:;" onclick="changeHash('aboutUs')"><img style="float: right;"
                                                                          src="img/btn_learn.png"></a>
            </a>
        </div>
    </div>


    <div style="width: 33% ; float: left;padding-right: 1%;padding-left: 1%">
        <!--    联系我们-->
        <div style="float: left;margin-left: 2%">
            <div>
                <label style="color:#2a5bb0;font-size: 18px">Contact Us</label>
                <img class="imgBorder" src="img/contactus.jpg">
            </div>
            <div>
                <?php
                //查找联系方式
                require 'dbConfig.php';
                //查找数据库 FAQ数据
                $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
                //判断是否连接成功
                if (!$mysqli) {
                    echo mysqli_connect_error();
                    exit;
                }

                $sql = "select * from article where articleType='mainContactUs' limit 1";

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
            <!--                        <div>-->
            <!--                            <a href="javascript:;">-->
            <!--                                <a href="javascript:;" onclick="goto('contactUs.php')"><img style="float: right;"-->
            <!--                                                                                            src="img/btn_learn.png"></a>-->
            <!--                            </a>-->
            <!--                        </div>-->
        </div>
    </div>

</div>

<div class="clearfix"></div>

<script>
    $(function () {
        // 初始化轮播
        $("#myCarousel").carousel({interval: 3000});
    });
</script>
