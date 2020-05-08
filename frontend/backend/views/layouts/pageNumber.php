<!--分页代码-->
<div class="box-footer clearfix">
    <div class="form-group col-md-4">
        <?php
        if (!empty($data)) {
            $counts = $data['data']['counts'];
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
    </div>
    <ul class="pagination pagination-sm no-margin pull-right" id="formId">
        <li class="previous_page"><a href="#">&laquo;</a></li>
        <?php
        if (!empty($postIndex)) {
            if ($postIndex < 5) {
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $countsPage) {
                        if ($i != $postIndex) {
                            echo '<li><a id=li' . $i . '" href="#">' . $i . '</a></li>';
                        } else {
                            echo '<li class="active"><a id=li' . $i . '" data-id="' . $i . '" href="#">' . $i . '</a></li>';
                        }
                    }
                }
            } else if (($postIndex || $postIndex + 1 || $postIndex + 2) == $countsPage) {
//                          alert(124);
                for ($i = $postIndex - 2; $i <= $postIndex + 2; $i++) {
                    if ($i > 0 && $i <= $countsPage) {
                        if ($i != $postIndex) {
                            echo '<li><a id=li' . $i . '" href="#">' . $i . '</a></li>';
                        } else {
                            echo '<li class="active"><a id=li' . $i . '" data-id="' . $i . '" href="#">' . $i . '</a></li>';
                        }
                    }
                }
            } else if ($postIndex + 4 > $countsPage) {
                for ($i = $postIndex + 4; $i < $countsPage; $i++) {
                    if ($i > 0) {
                        if ($i != $postIndex) {
                            echo '<li><a id=li' . $i . '" href="#">' . $i . '</a></li>';
                        } else {
                            echo '<li class="active"><a id=li' . $i . '" data-id="' . $i . '" href="#">' . $i . '</a></li>';
                        }
                    }
                }
            } else {
                for ($i = $postIndex - 2; $i <= $postIndex + 2; $i++) {
                    if ($i > 0 && $i <= $countsPage) {
                        if ($i != $postIndex) {
                            echo '<li><a id=li' . $i . '" href="#">' . $i . '</a></li>';
                        } else {
                            echo '<li class="active"><a id=li' . $i . '" data-id="' . $i . '" href="#">' . $i . '</a></li>';
                        }
                    }
                }
            }
            echo '<input type="hidden" name="hiddenindex" data-counts="' . $postIndex . '" data-last-counts="' . $countsPage . '" id="hiddenindex" value="" >';
        } ?>
        <li class="next_page"><a href="#">&raquo;</a></li>
    </ul>
    <div class="form-group pull-right" style="margin-right: 20px;">
        <label>共 <?php echo isset($countsPage) ? $countsPage : null; ?> 页/第</label>
        <input type="number" style="display: inline-block; width: 60px; margin: 0 4px;"
               class="form-control input-sm" id="toPageNumber" name=""
               max="<?php echo isset($countsPage) ? $countsPage : null; ?>"
               value="<?php echo isset($postIndex) ? $postIndex : null; ?>">
        <label style="display: inline-block;">页</label>
    </div>
</div>