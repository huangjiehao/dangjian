$(function () {
    var edit=$('.edit').val();
    if(edit=='edit'){
        var rslh=$('.resumeListHide').val();
        if(rslh!=''){
            $('.resume_tr:first').remove();
        }
        var fmlh=$('.familyMemberListHide').val();
        if(fmlh!=''){
            $('.homebase_tr:first').remove();
        }
        var rtlh=$('.relativeListHide').val();
        if(rtlh!=''){
            $('.socialbase_tr:first').remove();
        }
    }


})
function addDevelopmentTr(i) {
	var $tr=$(i).prev().find("tr:first").clone();
	var $tb=$(i).prev();
    $tr.appendTo($tb);
    $tr.find(":input").each(function(i){
        $(this).val("");
    });
}
function delDevelopmentTr(i) {
    var length = $(i).parents("table").find("tr").length;
    if(length<=1){
        alert("至少保留一行")
    }else {
        $(i).parent().parent().remove();
    }
}
function changTime(strtime) {
    if(strtime==null||strtime==undefined){
        return null;
    }else {
        var a= strtime.replace(/年/g, '/');
        var b=a.replace(/月/g,'/');
        var date = new Date(b);
        var time =parseInt(Date.parse(date))/1000 ;
        return time;
    }

}
function savedevelopment() {

}
