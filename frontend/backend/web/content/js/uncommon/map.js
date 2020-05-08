$(function () {
    var dataSource = $('#dataSource').text();
    dataSource = JSON.parse(dataSource);

    function compare(property) { //根据左值json数组排序
        return function (a, b) {
            var value1 = a[property];
            var value2 = b[property];
            return value1 - value2;
        }
    }

    dataSource = dataSource.sort(compare('lftVal'));

    var setting = {
        view: {
            selectedMulti: false
        },
        check: {
            enable: false
        },
        data: {
            simpleData: {
                enable: true
            }
        },
        edit: {
            enable: false
        }
    };
    var authTree = null;
    if (dataSource != "") {
        var nodes = new Array(); //定义一个数组
        for (var i = 0; i < dataSource.length; i++) {
            var node = {
                id: dataSource[i].idStr,
                pId: dataSource[i].parentIdStr,
                name: dataSource[i].name,
                idStr: dataSource[i].idStr,
                fullName: dataSource[i].fullName,
                lat: dataSource[i].lat,
                lng: dataSource[i].lng,
                address: dataSource[i].address,
                open: true
            };
            nodes[i] = node;
        }
        authTree = $.fn.zTree.init($("#treeDemo"), setting, nodes); //初始化树 写body里 （<ul id="treeDemo" class="ztree"></ul>,数组 nodes）
        treeObj = $.fn.zTree.getZTreeObj("treeDemo");
    }
    //获取树结构结束

    initMap();
    initMarker();
});
var myIcon = null;
var mapgis = null;
var searchInfoWindow = null;

function initMap() {
    var str = $("#mygis").val();
    var mygis = JSON.parse(str);

    mapgis = new BMap.Map("allmap", {
        minZoom: 16,
        maxZoom: 19,
        mapType: BMAP_NORMAL_MAP
    }); // 创建Map实例
    var lat = $("#lat").val();
    var lng = $("#lng").val();
    mapgis.centerAndZoom(new BMap.Point(lat, lng), 18); //BMap.Point(113.280044, 23.139266), 18
    /* mapgis.disableDragging(); */
    mapgis.enableScrollWheelZoom(true);//开启鼠标滚轮缩放
    // mapgis.disableScrollWheelZoom(true);
    mapgis.addControl(new BMap.NavigationControl());
    mapgis.addControl(new BMap.MapTypeControl({
        mapTypes: [
            BMAP_NORMAL_MAP
            // BMAP_SATELLITE_MAP,//卫星
            // BMAP_HYBRID_MAP,//混合
            // BMAP_PERSPECTIVE_MAP//三维
        ]
    }));

    //图标
    myIcon = new BMap.Icon("/content/images/tubiao.png", new BMap.Size(30, 30));
    // myIcon = new BMap.Icon("/content/images/hongqi30px.gif", new BMap.Size(30, 30));
    initMarker(mapgis, myIcon);

}

function initMarker() {//mapgis,myIcon
    var str = $("#mygis").val();

    var mygis = JSON.parse(str);
    var mymarker = null;
    for (var k = 0; k < mygis.length; k++) {
        var lat = mygis[k].lat;
        var lon = mygis[k].lng;
        mymarker = new BMap.Marker(new BMap.Point(lat, lon), {icon: myIcon}); // 创建marker对象
        mymarker.gisInfo = mygis[k];
        mapgis.addOverlay(mymarker);

        /* 标注*/
        var point = new BMap.Point(lat, lon);
        var myLabel = new BMap.Label(mygis[k]['name'], {offset: new BMap.Size(6, -15), position: point});
        myLabel.gisInfo = mygis[k];
        myLabel.marker = mymarker;
        mapgis.addOverlay(myLabel);
        myLabel.setStyle({
            color: "white",
            fontSize: "12px",
            lineHeight: "20px",
            fontFamily: "微软雅黑",
            cursor: "pointer",
            backgroundColor: "red",
            borderRadius: "4px"
        });
        mymarker.addEventListener("click", function (e) {
            var point = e.target;
            openOrgInfoWindow(point);
        });//点击图标弹出
        myLabel.addEventListener("click", function (e) {
            var point = e.target;
            openOrgInfoWindow(point);
        });//点击文本弹出
    }
}

function openOrgInfoWindow(marker) {
    var content = $("#windowInfo").html();
    // var newsList = '';
    // newsList ='<li><i class="fa fa-circle"></i><a href="#" target="_blank" style="padding-left: 10px;" title="'+marker.gisInfo.address+'">'+marker.gisInfo.address+'</a></li>';
    var mapValue = {};
    mapValue.fullName = marker.gisInfo.fullName;
    mapValue.address = marker.gisInfo.address;
    mapValue.idStr = marker.gisInfo.idStr;
    mapValue.name = marker.gisInfo.name;

    var html = replace(content, mapValue);
    searchInfoWindow = new BMapLib.SearchInfoWindow(mapgis, html, {
        title: marker.gisInfo.name, // 标题
        width: 300, // 宽度
        height: 120, // 高度
        panel: "panel", // 检索结果面板
        enableAutoPan: true, // 自动平移
        searchTypes: []
    });

    searchInfoWindow.open(marker.marker || marker);
    // searchInfoWindow.open(marker,point);
}

function replace(src, data) {
    for (var key in data) {
        var reg = new RegExp('\\#\\[' + key + '\\]', 'g');
        src = src.replace(reg, data[key]);
    }
    return src;
}

$(document).on("click", ".node_name", function () {
    var address = $(this).data("address");
    var lat = $(this).data("lat");
    var lon = $(this).data("lng");
    var name = $(this).data("name");
    var fullName = $(this).data("full");
    var idStr = $(this).data("id");
    var myMarker = new BMap.Marker(new BMap.Point(lat, lon));
    myMarker.gisInfo = {address: address, name: name, fullName: fullName, idStr: idStr};
    openOrgInfoWindow(myMarker);
});

//查找机构
function doSearch() {
    var search_str = $("#search_str").val();
    var mynodes = treeObj.getNodesByParamFuzzy("name", search_str, null);
    var treeNode = mynodes[0];
    var lat = treeNode.lat;
    var lon = treeNode.lng;
    var address = treeNode.address;
    var name = treeNode.name;
    var fullName = treeNode.fullName;
    var idStr = treeNode.idStr;
    var myMarker = new BMap.Marker(new BMap.Point(lat, lon));
    myMarker.gisInfo = {address: address, name: name, fullName: fullName, idStr: idStr};
    openOrgInfoWindow(myMarker);

}
