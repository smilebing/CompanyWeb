<?php
if (isset($_SESSION['user_account'])) {
    $username = $_SESSION['user_account'];
}
else{
    header('Location:Home.php');
    exit;
}
?>
<style>
    #main-nav {
        margin-left: 1px;
    }

    #main-nav.nav-tabs.nav-stacked > li > a {
        padding: 10px 8px;
        font-weight: 600;
        color: rgb(13, 102, 194);
        background: #E9E9E9;
        background: -moz-linear-gradient(top, #FAFAFA 0%, #E9E9E9 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #FAFAFA), color-stop(100%, #E9E9E9));
        background: -webkit-linear-gradient(top, #FAFAFA 0%, #E9E9E9 100%);
        background: -o-linear-gradient(top, #FAFAFA 0%, #E9E9E9 100%);
        background: -ms-linear-gradient(top, #FAFAFA 0%, #E9E9E9 100%);
        background: linear-gradient(top, #FAFAFA 0%, #E9E9E9 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FAFAFA', endColorstr='#E9E9E9');
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#FAFAFA', endColorstr='#E9E9E9')";
        border: 1px solid #D5D5D5;
        border-radius: 4px;
    }

    #main-nav.nav-tabs.nav-stacked > li > a > span {
        color: #4A515B;
    }

    #main-nav.nav-tabs.nav-stacked > li.active > a, #main-nav.nav-tabs.nav-stacked > li > a:hover {
        color: #FFF;
        background: rgb(13, 102, 194);
        background: -moz-linear-gradient(top, #4A515B 0%, #3C4049 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #4A515B), color-stop(100%, #3C4049));
        background: -webkit-linear-gradient(top, #4A515B 0%, #3C4049 100%);
        background: -o-linear-gradient(top, #4A515B 0%, #3C4049 100%);
        background: -ms-linear-gradient(top, #4A515B 0%, #3C4049 100%);
        background: linear-gradient(top, #4A515B 0%, #3C4049 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#4A515B', endColorstr='#3C4049');
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#4A515B', endColorstr='#3C4049')";
        border-color: #2B2E33;
    }

    #main-nav.nav-tabs.nav-stacked > li.active > a, #main-nav.nav-tabs.nav-stacked > li > a:hover > span {
        color: #FFF;
    }

    #main-nav.nav-tabs.nav-stacked > li {
        margin-bottom: 4px;
    }

    /*定义二级菜单样式*/
    .secondmenu a {
        font-size: 10px;
        color: #4A515B;
        text-align: center;
    }

    .navbar-static-top {
        background-color: rgb(13, 102, 194);
        margin-bottom: 5px;
    }

    .navbar-brand {
        background: url('') no-repeat 10px 8px;
        display: inline-block;
        vertical-align: middle;
        padding-left: 50px;
        color: #fff;
    }
    .dropdown >ul> li> a{
        hover: #4A515B;
    }

    .nav>li>a:focus, .nav>li>a:hover
    {
        background-color: #428bca;
    }

    .container-fluid>.nav>li>ul>li>a:hover
    {
        background-color: red;
    }
</style>

<div class="navbar navbar-duomi navbar-static-top" role="navigation">
    <div class="container-fluid">
        <span class="navbar-brand " id="logo">后台内容管理</span>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false" style="color: #fff;"><?php echo $username ?> <span class="caret"></span></a>
                <ul class="dropdown-menu"  style="background-color: red">
                    <li><a href="javascript:;" style="color: #fff" onclick="loginOut()">退出登录</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div   >


<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <ul id="main-nav" class="nav nav-tabs nav-stacked" style="">
                <li>
                    <a href="Home.php">
                        <i class="glyphicon glyphicon-th-large"></i>
                        首页
                    </a>
                </li>
                <li>
                    <a href="#mainSetting" class="nav-header collapsed" data-toggle="collapse">
                        <i class="glyphicon glyphicon-cog"></i>
                        主页修改
                        <span class="pull-right glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul id="mainSetting" class="nav nav-list collapse secondmenu" style="height: 0px;">
                        <li><a href="javascript:;" onclick="gotoMainEditor('products')"><i class="glyphicon glyphicon-th-list"></i>Products内容</a></li>
                        <li><a href="javascript:;" onclick="gotoMainEditor('aboutus')"><i class="glyphicon glyphicon-th-list"></i>About Us内容</a></li>
                        <li><a href="javascript:;" onclick="gotoMainEditor('contactus')"><i class="glyphicon glyphicon-th-list"></i>Contact Us内容 </a></li>
                    </ul>
                </li>
                <li>
                    <a href="#systemSetting" class="nav-header collapsed" data-toggle="collapse">
                        <i class="glyphicon glyphicon-cog"></i>
                        Product管理
                        <span class="pull-right glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul id="systemSetting" class="nav nav-list collapse secondmenu" style="height: 0px;">
                        <li><a href="javascript:;" onclick="goto('productList.php')"><i class="glyphicon glyphicon-user"></i>Product类别管理</a></li>
                        <li><a href="javascript:;" onclick="goto('manageProduct.php')"><i class="glyphicon glyphicon-th-list"></i>Product内容管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" onclick="gotoEditor('service')">
                        <i class="glyphicon glyphicon-credit-card"></i>
                        修改Service
                    </a>
                </li>

                <li>
                    <a href="javascript:;" onclick='gotoEditor("culture")'>
                        <i class="glyphicon glyphicon-globe"></i>
                        修改Culture
                        <span class="label label-warning pull-right"></span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" onclick='gotoEditor("contactus")'>
                        <i class="glyphicon glyphicon-globe"></i>
                        修改Contact Us
                        <span class="label label-warning pull-right"></span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" onclick='gotoEditor("aboutus")'>
                    <i class="glyphicon glyphicon-globe"></i>
                        修改About Us
                        <span class="label label-warning pull-right"></span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" onclick='gotoEditor("promotions")'>
                        <i class="glyphicon glyphicon-calendar"></i>
                        修改Promotions
                    </a>
                </li>
                <li>
                    <a href="javascript:;" onclick='goto("message.php")'>
                        <i class="glyphicon glyphicon-calendar"></i>
                        查看留言
                    </a>
                </li>

                <li>
                    <a href="javascript:;" onclick='goto("userInfo.php")'>
                        <i class="glyphicon glyphicon-fire"></i>
                        密码修改
                    </a>
                </li>
            </ul>
        </div>

        <div id="Main" style="float: left;width: 80%">
            <div class="panel panel-default">
                <div class="panel-heading">注意事项</div>
                <div>
                    1.如果产品A的产品类别为B，那么则不能直接删除产品类别B，需要先将B类别的产品全部删除后才能删除类别B。<br>
                    2.修改页面内容后，如果页面显示不正常，请尝试将页面内容修改的稍微窄一点。<br>
                    3.添加产品时，产品预览图片必须并且只能上传一张
                    4.关于产品的排序：在添加产品时，可以默认填写一个比较大的数值（比如20,30），如果需要某个产品排在最前面，那么该产品的排序序号必须在该产品类别中为最小的
                </div>
            </div>
        </div>
    </div>
</div>