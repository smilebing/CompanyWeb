function changeHash(url) {
    window.location.hash=url;
}

function goto(url) {
    $.get(url,function (result) {
            $('#Main').html(result);
        }
    );
}

function goto(url,parm) {
    $.get(url,parm,function (result) {
        $('#Main').html(result);
    });
}

function searchProductByHash() {
    var searchName=$('#searchName').val().trim();
    window.location.hash='#search/'+searchName;
}

function searchProduct() {
    var searchName=$('#searchName').val().trim();
    $.get('productsLeft.php',function (result) {
        $('#Main').html(result);
    }).then(function () {
        $.get('products.php', {'searchName': searchName}, function (result) {
            $('#productRightDiv').html(result);
        });
    });
}

function searchProduct(searchName) {
    $.get('productsLeft.php',function (result) {
        $('#Main').html(result);
    }).then(function () {
        $.get('products.php', {'searchName': searchName}, function (result) {
            $('#productRightDiv').html(result);
        });
    });
}

function showHashProducts(productHashType) {
    window.location.hash='#products/'+productHashType;
}

function  showHashProductDetail(productHashId,productType) {
    if(window.location.hash.indexOf("products")!=-1)
    {
        window.location.hash+='/'+productHashId;
    }
    else
    {
        window.location.hash='#products/'+productType+'/'+productHashId;
    }
}

function showProducts(productType) {
    $.get('products.php', {'type': productType}, function (data) {
        $('#productRightDiv').html(data);
    })
}

function showProductDetail(productId) {
    $.get('products.php', {'productId': productId}, function (data) {
        $('#productRightDiv').html(data);
    })
}

function  indexGoToProductList(type) {
    if($('#productRightDiv').length>0)
    {
        showProducts(type);
    }
    else {
        $.get('productsLeft.php',function (result) {
                $('#Main').html(result);
            }
        ).then(function () {
            showProducts(type);
        });
    }
}

function indexGoToProduct(id) {
    if($('#productRightDiv').length>0)
    {
        showProductDetail(id);
    }
    else {
        $.get('productsLeft.php',function (result) {
                $('#Main').html(result);
            }
        ).then(function () {
            showProductDetail(id);
        });
    }
}

