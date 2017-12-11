function addProduct() {
    var name=$('#productNameInput').val();
    var productType=$('#productTypeSelect').val();
    var description=UE.getEditor('editor').getContent();
    $.post('editProduct.php',{'name':name,'description':description,'productType':productType},function (data) {
        if (data.result) {
            swal({
                text: '保存成功',
                type: 'success',
                timer: 3000
            }).then(function () {
                goto('manageProduct.php');
            });
        } else {
            swal({
                text: '保存失败',
                type: 'error',
                timer: 3000
            });
        }
    });
}


function saveEditorContent()
{
    var id=$('#id').val();
    var content=UE.getEditor('editor').getContent();
    $.post('saveEditor.php',{'id':id,'content':content},function (data){
        if(data.result)
        {
            swal({
                text: "保存成功",
                type: "success"
            });
        }
        else{
            swal({
                text: "保存失败",
                type: "error"
            });
        }
    });
}

function saveMainEditorContent() {
    var id=$('#id').val();
    var content=UE.getEditor('editor').getContent();
    $.post('saveEditor.php',{'mainid':id,'maincontent':content},function (data){
        if(data.result)
        {
            swal({
                text: "保存成功",
                type: "success"
            });
        }
        else{
            swal({
                text: "保存失败",
                type: "error"
            });
        }
    });
}


function gotoEditor(action) {
    $.get('editor.php',{'action':action},function(result)
    {
        $('#Main').html(result);
    }).then(function()
    {
        var editor = new UE.ui.Editor();
        editor.render('editor');
    });
}

function gotoMainEditor(type) {
    $.get('editMain.php',{'type':type},function(result)
    {
        $('#Main').html(result);
    }).then(function()
    {
        var editor = new UE.ui.Editor();
        editor.render('editor');
    });
}


function loginOut() {
    $.post('login.php', {'action': 'loginOut'}, function (data) {
        if (data.result == true) {
            window.location.href = "index.php";
        }
        else {
            swal({
                text: "退出失败",
                type: "error",
                timer: 3000
            });
        }
    })
}

function delMessage(id) {
    swal({
        title: '警告',
        text: '是否要删除',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: "确定",
        cancelButtonText: "取消",
    }).then(function (isConfirm) {
        if (isConfirm) {
            $.post('message.php',{'id':id},function (data) {
                if(data.result)
                {
                    swal({
                        text: "删除成功",
                        type: "success"
                    });
                    goto('message.php');
                }
                else{
                    swal({
                        text: "删除失败",
                        type: "error"
                    });
                }
            });
        }
    }).catch(swal.noop);
}
