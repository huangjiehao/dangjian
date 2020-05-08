function removeWishiper(i) {
    var idStr=$(i).data('id');
    $.ajax({
        url: '/wish/wishelper_remove',
        type: 'post',
        data: {'idStr':idStr},
        dataType:'JSON',
        success: function (result) {
            console.dir(result);
            if (result['status']=='1000') {
                swal({
                    title: "删除成功",
                    type: "success",
                    confirmButtonText: "确定"
                }, function (isConfirm) {
                    if (isConfirm) {
                        window.location.reload();
                    }
                });

            } else {
                swal({
                    title: "删除失败",
                    text: result['msg'],
                    type: "error",
                    confirmButtonText: "确定"
                }, function (isConfirm) {
                    if (isConfirm) {
                        swal.close();
                    }
                });
            }
        }, error: function (error) {
            console.dir(error);
        }
    });
}