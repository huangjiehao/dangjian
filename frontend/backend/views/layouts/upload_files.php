<?php

?>
<div class="upload-files-wrapper">
    <input type="hidden" class="upload-files-result">
    <div class="tools-box">
        <div class="btn btn-success upload-files-add-files">
            <i class="glyphicon glyphicon-plus"></i>
            <span>添加文件</span>
            <input type="file" class="upload-files-file" multiple=""
                   accept=".jpg,.jpeg,.png,.doc,.docx,.pdf,.ppt,.pptx,.mp4,.rmvb,.flv,.mp3">
        </div>
        <button class="btn btn-primary upload-files-submit-btn">
            <i class="glyphicon glyphicon-upload"></i>
            <span>上传文件</span>
        </button>
        <!--        <button type="button" class="btn btn-danger upload-files-delete-btn">-->
        <!--            <i class="glyphicon glyphicon-trash"></i>-->
        <!--            <span>清空文件</span>-->
        <!--        </button>-->
<!--        <b style="color:red;">暂时无法上传大于2M的文件</b>-->
    </div>
    <div class="upload-files-box">
        <div class="upload-files-item hide">
            <div class="u-p-td u-p-img">
                <img src=""/>
            </div>
            <div class="u-p-td u-p-name">
                <input class="form-control" type="text">
            </div>
            <div class="u-p-td u-p-p-s">
                <div class="u-p-top">
                    <p class="u-p-size"></p>
                    <p class="u-p-speed">准备上传</p>
                </div>
                <div class="u-p-pro">
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0"
                         aria-valuemax="100" aria-valuenow="0">
                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                    </div>
                </div>
            </div>
            <div class="u-p-td u-p-opt">
                <div class="upload-files-loading">
                    <img src="/content/img/loading.gif" alt="">
                </div>
                <button type="button" class="btn btn-danger upload-files-delete-s-btn">
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>删除</span>
                </button>
                <!--                <div class="btn btn-success upload-files-ok ">-->
                <!--                    <i class="glyphicon glyphicon-ok"></i>-->
                <!--                </div>-->
            </div>
        </div>
    </div>
</div>
<style>
    .u-p-name input {
        width: 80%;
    }

    .hide {
        display: none;
    }

    .upload-files-wrapper {
        width: 100%;
    }

    .tools-box {
        width: 100%;
    }

    .upload-files-file {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .upload-files-delete-btn {
        /*float:right;*/
    }

    .upload-files-add-files {
        border-radius: 5px;
        position: relative;
        cursor: pointer;
    }

    .upload-files-item {
        width: 100%;
        margin-top: 10px;
        padding-bottom: 5px;
        border-bottom: 1px solid rgba(128, 128, 128, .12);
    }

    .u-p-td {
        display: inline-block;
    }

    .u-p-img {
        width: 15%;
    }

    .u-p-img img {
        max-width: 100%;
    }

    .u-p-name {
        width: 30%;
    }

    .u-p-p-s {
        width: 33%;
    }

    .u-p-p-s p {
        display: inline-block;
        font-size: 12px;
    }

    .u-p-top {
        width: 100%;
        float: left;
    }

    .u-p-p-s .u-p-speed {
        float: right;
    }

    .u-p-pro{
        width:100%;
        float: left;
    }

    .u-p-opt {
        width: 20%;
        text-align: right;
    }

    .u-p-size {
        margin-bottom: 5px;
    }

    .btn-primary:hover {
        background-color: #3071a9 !important;
        border-color: #285e8e !important;
    }

    .btn-primary {
        background-color: #428bca !important;
        border-color: #357ebd !important;
    }

    .btn-success {
        background-color: #00a65a !important;
    }

    .btn-danger {
        background-color: #dd4b39 !important;
    }

    .upload-files-ok {
        visibility: hidden;
    }

    .upload-files-loading {
        display: none;
        position: absolute;
        width: 32px;
        height: 32px;
        z-index: 9;
        /*background: url('') no-repeat center ;*/
    }

    .upload-files-loading img {
        width: 100%;
    }

    .files-data {
        display: none;
    }

    .progress {
        overflow: hidden;
        height: 20px;
        margin-bottom: -10px;
        background-color: #f5f5f5;
        border-radius: 4px;
        box-shadow inset 0 1px 2px rgba(0, 0, 0, .1);
    }

</style>