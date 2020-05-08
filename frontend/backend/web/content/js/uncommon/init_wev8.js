function openFullWindow(url) {
    if (!url) {
        return;
    }
    var width = screen.availWidth * 0.8;
    var height = screen.availHeight * 0.8;
    openWindow(url, width, height);
}

function openSmallWindow(url) {
    if (!url) {
        return;
    }
    var width = screen.availWidth * 0.5;
    var height = screen.availHeight * 0.5;
    openWindow(url, width, height);
}
function openMediumWindow(url) {
    if (!url) {
        return;
    }
    var width = screen.availWidth * 0.8;
    var height = screen.availHeight * 0.5;
    openWindow(url, width, height);
}

/**
 * 通用导入数据页面
 * @param title 页面标题
 * @param mid 导入模板id
 */
function openImportWindow(title, tid) {
    openWindow('/layouts/import_file?title=' + encodeURIComponent(title) + '&tid=' + tid, 800, 500);
}

/**
 * 通用导出数据页面
 * @param title 页面标题
 */
function openExportWindow(title, tid) {
    var url = window.location;
    var param = url.search;
    if (!param) {
        param += '?';
    } else {
        param += '&';
    }
    param += 'title=' + encodeURIComponent(title) + '&tid=' + tid;
    openWindow('/layouts/export_file' + param, 800, 300);
}

function openWindow(url, width, height) {
    if (!url) {
        return;
    }
    // var url = "send_detail.html";
    var redirectUrl = url;
    //if (height == 768 ) height -= 75 ;
    //if (height == 600 ) height -= 60 ;
    var szFeatures = "top=" + ((screen.availHeight - height) / 2) + ",";
    szFeatures += "left=" + ((screen.availWidth - width) / 2 - 30) + ",";
    szFeatures += "width=" + width + ",";
    szFeatures += "height=" + height + ",";
    szFeatures += "directories=no,";
    szFeatures += "status=yes,toolbar=no,location=no,";
    szFeatures += "menubar=no,";
    szFeatures += "scrollbars=yes,";
    szFeatures += "resizable=yes"; //channelmode
    window.open(redirectUrl, "", szFeatures);
}

function closeWindow(win) {
    win.close();
    self.opener.location.reload();
}


/**
 * 判断是否有常规/普通菜单
 * @param arr
 * @returns {boolean}
 */
function hasNormalMenu(arr, setting) {
    if (setting && setting.allShow != undefined && setting.allShow == 1) {
        return true;
    }
    for (var i in arr) {
        var item = arr[i];
        if (item.menuType == 0) {
            return true;
        }
    }
    return false;
}

/**
 * 根据获取菜单
 * @param arr
 * @param menuType
 * @returns {Array}
 */
function getChildrenData(arr, menuType) {
    var result = [];
    for (var i in arr) {
        var item = arr[i];
        if (item.menuType == menuType) {
            result.push(item);
        }
    }
    return result;
}
function showSwal(status, title, msg, close) {
    var type = '';
    if (status == 1 || status == 2) {
        type = 'success';
        if (!title) {
            title = '操作成功';
        }
    } else if (status) {
        type = 'error';
        if (!title) {
            title = '操作失败';
        }
    }
    if (status == 2) {
        swal({
                title: title,
                type: type,
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                cancelButtonColor: "#1872ab",
                confirmButtonText: "关闭窗口",
                cancelButtonText: '继续添加',
            },
            function (isConfirm) {
                if (isConfirm) {
                    closeWindow(window);
                } else {
                    swal.close();
                }
            });
        window.location.hash = 'ok';
    } else if (status) {
        swal({
                title: title,
                text: msg,
                type: type,
                confirmButtonText: "确 定",
            },
            function (isConfirm) {
                if (isConfirm) {
                    if (close) {
                        closeWindow(window);
                        swal.close();
                    } else {
                        swal.close();
                    }
                }
            });
    }
}

function number_format(number, decimals, dec_point, thousands_sep) {
    /*
     * 参数说明：
     * number：要格式化的数字
     * decimals：保留几位小数
     * dec_point：小数点符号
     * thousands_sep：千分位符号
     * */
    if (!decimals) {
        decimals = 2;
    }
    if (!dec_point) {
        dec_point = '.';
    }
    if (!thousands_sep) {
        thousands_sep = ',';
    }
    number = (number + '').replace(/[^0-9+-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.ceil(n * k) / k;
        };

    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    var re = /(-?\d+)(\d{3})/;
    while (re.test(s[0])) {
        s[0] = s[0].replace(re, "$1" + sep + "$2");
    }

    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

$(function () {

    $(document).on('click', '.main_link', function () {
        window.location.href = $(this).attr('href');
        return false;
    });
    $('.change_btn a').on('click', function () {
        $('.control-sidebar').toggleClass('control-sidebar-open')
    })
})