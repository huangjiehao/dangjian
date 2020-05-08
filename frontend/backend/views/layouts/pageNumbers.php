<!--分页代码-->
<?php
if (!empty($page)) {
    $counts = $page['counts'];
    $postLimitCounts = $page['limitCounts'];
    $postIndex = $page['pageNumber'];

    $countsInt = floor($counts / $postLimitCounts);

    //计算页数
    if ($counts % $postLimitCounts != 0) {
        $countAdd = 1;
    } else {
        $countAdd = 0;
    }
    //分页总数
    $countsPage = $countsInt + $countAdd;

}
?>

<input type="hidden" class="search_params" name="page" value="1">
<div class="box-footer  page-box <?= !empty($page) && $counts > 0 ? '' : 'hide' ?>">
    <ul class="pagination pagination-sm no-margin active_ele" id="layoutPagination" style="margin: 0 20px;"
        data-active-name="page">
        <li class="previous_page"><a href="#">&laquo;</a></li>
        <?php
        if (!empty($postIndex)) {
            if ($postIndex < 5) {
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $countsPage) {
                        if ($i != $postIndex) {
                            echo '<li data-active-val="' . $i . '"><a id=li' . $i . '" data-id="' . $i . '" href="javascript:void(0);">' . $i . '</a></li>';
                        } else {
                            echo '<li data-active-val="' . $i . '" class="active"><a id=li' . $i . '" data-id="' . $i . '" href="javascript:void(0);">' . $i . '</a></li>';
                        }
                    }
                }
            } else if (($postIndex || $postIndex + 1 || $postIndex + 2) == $countsPage) {
//                          alert(124);
                for ($i = $postIndex - 2; $i <= $postIndex + 2; $i++) {
                    if ($i > 0 && $i <= $countsPage) {
                        if ($i != $postIndex) {
                            echo '<li data-active-val="' . $i . '"><a id=li' . $i . '" data-id="' . $i . '" href="javascript:void(0);">' . $i . '</a></li>';
                        } else {
                            echo '<li data-active-val="' . $i . '" class="active"><a id=li' . $i . '" data-id="' . $i . '" href="javascript:void(0);">' . $i . '</a></li>';
                        }
                    }
                }
            } else if ($postIndex + 4 > $countsPage) {
                for ($i = $postIndex + 4; $i < $countsPage; $i++) {
                    if ($i > 0) {
                        if ($i != $postIndex) {
                            echo '<li data-active-val="' . $i . '"><a id=li' . $i . '" data-id="' . $i . '" href="javascript:void(0);">' . $i . '</a></li>';
                        } else {
                            echo '<li data-active-val="' . $i . '" class="active"><a id=li' . $i . '" data-id="' . $i . '" href="javascript:void(0);">' . $i . '</a></li>';
                        }
                    }
                }
            } else {
                for ($i = $postIndex - 2; $i <= $postIndex + 2; $i++) {
                    if ($i > 0 && $i <= $countsPage) {
                        if ($i != $postIndex) {
                            echo '<li data-active-val="' . $i . '"><a id=li' . $i . '" data-id="' . $i . '" href="javascript:void(0);">' . $i . '</a></li>';
                        } else {
                            echo '<li data-active-val="' . $i . '" class="active"><a id=li' . $i . '" data-id="' . $i . '" href="javascript:void(0);">' . $i . '</a></li>';
                        }
                    }
                }
            }
            echo '<input type="hidden" name="hiddenindex" data-counts="' . $postIndex . '" data-last-counts="' . $countsPage . '" id="hiddenindex" value="" >';
        } ?>
        <li class="next_page"><a href="#">&raquo;</a></li>
    </ul>
    <span class="page_right">
        <label>共 <?php echo isset($countsPage) ? $countsPage : null; ?> 页 / 第</label>
        <input type="number" style="display: inline-block; width: 60px; margin: 0 4px;"
               class="form-control input-sm" id="toPageNumber" name="" onkeyup="filtecharacter(this,0)" min="1"
               max="<?php echo isset($countsPage) ? $countsPage : null; ?>"
               value="<?php echo isset($postIndex) ? $postIndex : null; ?>" onkeyup="this.value=this.value.replace(/\D/g,'')">
        <label class="page_count" data-count="<?= isset($counts) ? $counts : 0 ?>"  style="display: inline-block;">页 / 共<?= isset($counts) ? $counts : 0 ?>条数据</label>
    </span>
</div>
<script type="text/javascript">
    //屏蔽输入的特殊字符
    var _arr=new Array();
    _arr[0]=/[\`\~\!\@\#\$\%\^\&\*\￥\(\)\……\！\（）\——\+\\\]\}\{\'\;\:\"\/\.\,\。\，\、\>\<\s\|\=\-\?]/g;
    _arr[1]=/[^\d]/g;
    //屏蔽输入的特殊字符
    function filtecharacter(obj, index) {
        obj.value = obj.value.replace(_arr[index], "");
    }
</script>