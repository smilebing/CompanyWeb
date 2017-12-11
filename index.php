<html>
<head>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no,email=no,address=no">
    <link rel="icon" href="img/logo.png" type="image/x-icon"/>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://cdn.bootcss.com/limonte-sweetalert2/6.10.1/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.bootcss.com/limonte-sweetalert2/6.10.1/sweetalert2.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font.css">
    <style>
        body {
            overflow-y: scroll;
        }
    </style>
    <title>Suzhou MHW Chemical Co Ltd</title>
</head>
<body>
<div style="">
    <div style="width:970px;margin: 0 auto;box-shadow: 5px 0px 10px -5px #aaa, -5px 0px 20px -5px #aaa;">
        <?php require 'header.php' ?>
        <div id="Main" class="" style="margin-left: 2%">


        </div>
        <?php require 'footer.php' ?>
    </div>
</div>
</body>

</html>
<script>
    $(function () {
        var hash;
        hash=(!window.location.hash)?"#index":window.location.hash;
        switch (hash) {
            case '#index':
                goto('main.php');
                break;
            case '#aboutUs':
                goto('aboutUs.php');
                break;
            case '#products':
                goto('products.php');
                break;
            case '#culture':
                goto('culture.php');
                break;
            case '#service':
                goto('service.php');
                break;
            case '#contactUs':
                goto('contactUs.php');
                break;
            case '#promotions':
                goto('promotions.php');
                break;
            default:
                var strs= new Array();
                strs=hash.split("/");
                if(strs.length==0){
                    return;
                }
                if(strs[0].indexOf('products')!=-1)
                {
                    if(strs.length==2)
                    {
                        indexGoToProductList(strs[1]);
                    }
                    else if(strs.length==3)
                    {
                        indexGoToProduct(strs[2]);
                    }
                }
                else if(strs[0].indexOf('search')!=-1)
                {
                    if(strs.length==2)
                    {
                        //search
                        searchProduct(strs[1]);
                    }
                }
                break;
        }
        window.location.hash = hash;
    });

    window.onhashchange = function() {
        var hash;
        hash=(!window.location.hash)?"#index":window.location.hash;
        switch (hash) {
            case '#index':
                goto('main.php');
                break;
            case '#aboutUs':
                goto('aboutUs.php');
                break;
            case '#products':
                goto('products.php');
                break;
            case '#culture':
                goto('culture.php');
                break;
            case '#service':
                goto('service.php');
                break;
            case '#contactUs':
                goto('contactUs.php');
                break;
            case '#promotions':
                goto('promotions.php');
                break;
            default:
                var strs= new Array();
                strs=hash.split("/");
                if(strs.length==0){
                    return;
                }
                if(strs[0].indexOf('products')!=-1)
                {
                    if(strs.length==2)
                    {
                        indexGoToProductList(strs[1]);
                    }
                    else if(strs.length==3)
                    {
                        indexGoToProduct(strs[2]);
                    }
                }
                else if(strs[0].indexOf('search')!=-1)
                {
                    if(strs.length==2)
                    {
                        //search
                        searchProduct(strs[1]);
                    }
                }

                break;
        }
    }
</script>



