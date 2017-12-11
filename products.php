<?php
/**
 * Created by PhpStorm.
 * User: zhuda
 * Date: 2017/10/21
 * Time: 22:42
 */
?>

<?php
if (isset($_GET['type'])) {
    $type = trim($_GET['type']);
//查看某个类型的产品集合
    require 'dbConfig.php';
    //查找数据库 FAQ数据
    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
    //判断是否连接成功
    if (!$mysqli) {
        echo mysqli_connect_error();
        exit;
    }

    $sql = "SELECT
	product.*, producttype.`name` typeName
FROM
	product
LEFT JOIN producttype ON product.productType = producttype.id
ORDER BY
	product.productType, IF (
                        isnull(product.orderNum),
                        1,
                        0
                    ),
                     product.orderNum";

    if ($type != 0) {
        $sql = "SELECT
	product.*, producttype.`name` typeName
FROM
	product
LEFT JOIN producttype ON product.productType = producttype.id
WHERE
	product.productType = ?
ORDER BY
	product.productType, IF (
                        isnull(product.orderNum),
                        1,
                        0
                    ),
                     product.orderNum";

        $stmt = $mysqli->prepare($sql);
//绑定参数 第一个参数为绑定的数据类型
        /*
        i:integer 整型
        d:double 浮点型
        s:string 字符串
        b:a blob packets blob数据包
        */
        $stmt->bind_param("i", $type);//绑定时使用变量绑定
    } else {
        $stmt = $mysqli->prepare($sql);
    }

//执行预处理
    $stmt->execute();
    $stmt->bind_result($id, $name, $description, $productType, $imgPath, $showInIndex, $orderNum, $typeName);
    $index = 1;
    $previousType = 0;
    $showDiv = false;
    $hasProduct=false;
    while ($stmt->fetch()) {
        $hasProduct=true;

        if (empty($imgPath) || $imgPath == '') {
            $imgPath = 'img/no-image-available.jpg';
        }

        $showDiv = true;

        if ($previousType != $productType) {
            if ($previousType > 0) {
                echo '</div>';
            }
            //新的类别，添加panel
            echo '<div class="panel panel-default">
                    <div class="panel-heading">
                        <label>' . $typeName . '</label>
                    </div>
                    </div>';

            //计数归1
            $previousType = $productType;
            $index = 1;
        }

        //输出产品行
        if ($index % 3 == 1) {
            echo '<div class="row">';
        }

        //输出产品
        echo ' <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="' . $imgPath . '" alt="...">
                <div class="caption">
                    <p>' . $name . '</p>
                    <p><a href="javascript:;" onclick="showHashProductDetail(' . $id . ')" class="btn btn-primary" role="button">Learn More</a> </p>
                </div>
            </div>
        </div>';

        if ($index % 3 == 0) {
            echo '</div>';
        }

        $index++;
    }
    if(!$hasProduct)
    {
        echo '<label>No product</label>';
    }
    if ($showDiv) {
        echo '</div>';
    }
    $stmt->close();
    $mysqli->close();
    exit;
}
?>

<?php
//查看某个产品
if (isset($_GET['productId'])) {
    $productId = trim($_GET['productId']);

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
	id = ?";

    $stmt = $mysqli->prepare($sql);
//绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $stmt->bind_param("i", $productId);//绑定时使用变量绑定

//执行预处理
    $stmt->execute();

//获取结果集
    $stmt->bind_result($id, $name, $description, $productType, $imgPath, $showInIndex, $orderNum);

    while ($stmt->fetch()) {
        echo $description;
    }
    $stmt->close();
    $mysqli->close();
    exit;
}
?>


<?php
//搜索某个产品
if (isset($_GET['searchName'])) {

    $searchName = trim($_GET['searchName']);
    $searchName = '%' . $searchName . '%';
    //require 'productsLeft.php';

    require 'dbConfig.php';
//查找数据库 FAQ数据
    $mysqli = new mysqli($mysql_server_name, $mysql_username, $mysql_password, $mysql_database);
//判断是否连接成功
    if (!$mysqli) {
        echo mysqli_connect_error();
        exit;
    }

    $sql = "SELECT
	product.*, producttype.name typeName
FROM
	product
LEFT JOIN producttype ON product.productType = producttype.id
WHERE
	product.name  like ?
ORDER BY
	product.productType, IF (
                        isnull(product.orderNum),
                        1,
                        0
                    ),
                     product.orderNum";

    $stmt = $mysqli->prepare($sql);
//绑定参数 第一个参数为绑定的数据类型
    /*
    i:integer 整型
    d:double 浮点型
    s:string 字符串
    b:a blob packets blob数据包
    */
    $stmt->bind_param("s", $searchName);//绑定时使用变量绑定

//执行预处理
    $stmt->execute();
    $stmt->bind_result($id, $name, $description, $productType, $imgPath, $showInIndex, $orderNum, $typeName);
    $index = 1;
    $previousType = -1;
    $showDiv = false;
    $hasProduct=false;

    //echo ' <div id="productRightDiv" style="width: 78%;float: right;margin-right: 5px">';

    while ($stmt->fetch()) {
        $hasProduct=true;

        if (empty($imgPath) || $imgPath == '') {
            $imgPath = 'img/no-image-available.jpg';
        }

        $showDiv = true;

        if ($previousType != $productType) {
            if ($previousType > 0) {
                echo '</div>';
            }
            //新的类别，添加panel
            echo '<div class="panel panel-default">
                    <div class="panel-heading">
                        <label>' . $typeName . '</label>
                    </div>
                    </div>';

            //计数归1
            $previousType = $productType;
            $index = 1;
        }

        //输出产品行
        if ($index % 3 == 1) {
            echo '<div class="row">';
        }

        //输出产品
        echo ' <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
                <img src="' . $imgPath . '" alt="...">
                <div class="caption">
                    <p>' . $name . '</p>
                    <p><a href="javascript:;" onclick="showProductDetail(' . $id . ')" class="btn btn-primary" role="button">Learn More</a> </p>
                </div>
            </div>
        </div>';

        if ($index % 3 == 0) {
            echo '</div>';
        }

        $index++;
    }
    if(!$hasProduct)
    {
        echo '<label>No product</label>';
    }
    if ($showDiv) {
        echo '</div>';
    }
    $stmt->close();
    $mysqli->close();

    //echo '</div>';
    exit;
}
?>


<?php
require 'productsLeft.php'
?>


<script>
    $(function () {
        showProducts(0);
    });
</script>
