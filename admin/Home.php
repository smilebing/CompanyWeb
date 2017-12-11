<?php
session_start();
if (!isset($_SESSION['user_account'])) {
    header('Location:index.php');
    exit;
}
?>

<head>
    <title>后台管理</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.bootcss.com/limonte-sweetalert2/6.10.1/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="https://cdn.bootcss.com/limonte-sweetalert2/6.10.1/sweetalert2.min.js"></script>
    <script src="js/admin.js"></script>

    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.config.js "></script>
    <script type="text/javascript" charset="utf-8" src="ueditor/ueditor.all.min.js"></script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="ueditor/lang/zh-cn/zh-cn.js"></script>



</head>

<body>
<?php require 'header.php'?>


</div>

</body>



