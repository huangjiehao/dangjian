<?php
use yii\helpers\Html;
?>

<div class="ly_main">
    <body class="gray-bg">
    <div class="middle-box text-center animated fadeInDown">
        <p><h2 style="color:red;"><i class="fa fa-close"></i>错误提示：</h2></p>
        <div class="error-desc">
            <h3><?=html::encode($data['errorMsg']) ?></h3>
        </div>
    </div>
    </body>
</div>
