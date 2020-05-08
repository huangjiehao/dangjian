
$(function(){
    //日期
    $('.date_picker').daterangepicker({
        autoUpdateInput: false,
        showDropdowns: true,
        alwaysShowCalendars: true,
        ranges: {
            '今天': [moment(), moment()],
            '昨天': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '最近7天': [moment().subtract(6, 'days'), moment()],
            '最近30天': [moment().subtract(29, 'days'), moment()],
            '本月': [moment().startOf('month'), moment().endOf('month')],
            '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale": {
            'cancelLabel': 'Clear',
            "format": "MM/DD/YYYY",
            "separator": " ~ ",
            "applyLabel": "应用",
            "cancelLabel": "取消",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "自定义",
            "daysOfWeek": [
                "日",
                "一",
                "二",
                "三",
                "四",
                "五",
                "六"
            ],
            "monthNames": [
                "1月",
                "2月",
                "3月",
                "4月",
                "5月",
                "6月",
                "7月",
                "8月",
                "9月",
                "10月",
                "11月",
                "12月"
            ],
            "firstDay": 1
        },
    });
    //日期-单个
    $('.date_picker_single').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        alwaysShowCalendars: true,
        ranges: {
            '今天': [moment(), moment()],
            '昨天': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '最近7天': [moment().subtract(6, 'days'), moment()],
            '最近30天': [moment().subtract(29, 'days'), moment()],
            '本月': [moment().startOf('month'), moment().endOf('month')],
            '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale": {
            "format": "YYYY/MM/DD",
            "separator": " ~ ",
            "applyLabel": "应用",
            "cancelLabel": "取消",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "自定义",
            "daysOfWeek": [
                "日",
                "一",
                "二",
                "三",
                "四",
                "五",
                "六"
            ],
            "monthNames": [
                "1月",
                "2月",
                "3月",
                "4月",
                "5月",
                "6月",
                "7月",
                "8月",
                "9月",
                "10月",
                "11月",
                "12月"
            ],
            "firstDay": 1
        },
    });
    //日期-单个
    $('.date_picker_month').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        alwaysShowCalendars: true,
        ranges: {
            '今天': [moment(), moment()],
            '昨天': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '最近7天': [moment().subtract(6, 'days'), moment()],
            '最近30天': [moment().subtract(29, 'days'), moment()],
            '本月': [moment().startOf('month'), moment().endOf('month')],
            '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "locale": {
            "format": "YYYY/MM",
            "separator": " ~ ",
            "applyLabel": "应用",
            "cancelLabel": "取消",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "自定义",
            "daysOfWeek": [
                "日",
                "一",
                "二",
                "三",
                "四",
                "五",
                "六"
            ],
            "monthNames": [
                "1月",
                "2月",
                "3月",
                "4月",
                "5月",
                "6月",
                "7月",
                "8月",
                "9月",
                "10月",
                "11月",
                "12月"
            ],
            "firstDay": 1
        },
    });


    $('.date_picker,.date_picker_single.date_picker_month').on('cancel.daterangepicker', function (ev, picker) {
        //$(this).val('');
    });
    $('.date_picker').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' ~ ' + picker.endDate.format('MM/DD/YYYY'));
    });
    $('.date_picker_month').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY年MM月'));
    });

    $('.date_picker_single').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD'));
    });
    //日期结束
    // document.getElementById("container_t").style.display='none';
});
function toogle_t(){
    $("#container_t").toggle(1000);
    /*var toggle = document.getElementById("container_t").style.display;
    if(toggle=='block'){
        document.getElementById("container_t").style.display='none';
    }
    if(toggle=='none'){
        document.getElementById("container_t").style.display='block';
    }*/
}

function openDialog(url,title,width,height,blankTab,maxiumnable){
    dialog = new window.top.Dialog();
    dialog.currentWindow = window;
    if(width){
        dialog.Width = width;
    }else{
        dialog.Width = 600;
    }
    if(height){
        dialog.Height = height;
    }else{
        dialog.Height = 260;
    }
    if(title){
        dialog.Title=title;
    }
    dialog.Drag = true;
    if(maxiumnable&&maxiumnable==true){
        dialog.maxiumnable=true;
    }
    if(blankTab==true){
        dialog.URL = "/proj/data/ProjectBlankTab.jsp?url="+url.replaceAll("&","%26",false) +"&title="+title;
    }else{
        dialog.URL = url;
    }
    //console.log("dialogurl:"+dialog.URL);
    dialog.show();
}