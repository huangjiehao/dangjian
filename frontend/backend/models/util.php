<?php
namespace app\models\util;
/**
 * @param $file_tmpname
 * 限制上传文件 的 宽高,大小，后缀名
 * $file = $_files['upfile'],$w 最大宽度，$h 最大高度，$size 最大文件 大小（单位为kb)，$type 后缀名
 */
function getImgW_H($file,$w,$h,$size,$type){

    $imgFileName = explode(".",$file['name']);
    $imgExt = $imgFileName[count($imgFileName)-1];
    if(!in_array($imgExt,explode(',',$type))){
        ?>
        <script type="text/javascript">
            alert("请输入后缀名为<?php echo $type; ?>的文件");
            window.history.go(-1);
        </script>
        <?php
        exit;
    }
    if(!empty($w)&&!empty($h)){
        $s = getimagesize($file['tmp_name']);
        $width = $s[0];
        $height = $s[1];
        if($width>$w || $height>$h){
            ?>
            <script type="text/javascript">
                alert("图片长或宽超出限制,宽<?php echo $w; ?>,高<?php echo $h; ?>");
                window.history.go(-1);
            </script>
            <?php
            exit;
        }
    }

    if($file['size']>$size*1024){
        ?>
        <script type="text/javascript">
            alert("图片过大,不大于<?php echo $size; ?>kb");
            window.history.go(-1);
        </script>
        <?php
        exit;
    }

}