/**
 * Created by Mars on 2018-01-25.
 */
$(function () {
        var filter = {
            "jpeg": "/9j/4",
            "gif": "R0lGOD",
            "png": "iVBORw"
        };
        var preimg = ['.jpg', '.jpeg', '.png', '.gif'];

        var layoutFiles = {};
        var resultFiles = {};

        function validateImg(data) {
            var pos = data.indexOf(",") + 1;
            for (var e in filter) {
                if (data.indexOf(filter[e]) === pos) {
                    return e;
                }
            }
            return null;
        }

        function previewImg(str) {
            for (var i in preimg) {
                if (str.indexOf(preimg[i]) != -1) {
                    return true;
                }
            }
            return false;
        }

        function validateFiles(accept, file) {
            var name = file['name'];
            var pos = name.lastIndexOf('.');
            var ext = name.substring(pos, name.length);
            var acceptArr = accept.split(',');
            for (var i in acceptArr) {
                if (ext == acceptArr[i]) {
                    return true;
                }
            }
            return false;
        }

        function existFiles(fileArr, uploadedFileArr, file) {
            if (fileArr && fileArr.length) {
                for (var i in fileArr) {
                    if (fileArr[i]['name'] == file['name']) {
                        return false;
                    }
                }
            }
            if (uploadedFileArr && uploadedFileArr.length) {
                for (var o in uploadedFileArr) {
                    if (uploadedFileArr[o]['name'] == file['name']) {
                        return false;
                    }
                }
            }
            return true;
        }

        function getFileSize(size) {
            if (!size) {
                return '-';
            }
            var fileSize = Math.round(size / 1024 * 100) / 100; //单位为KB
            if (fileSize > 1024 * 1024) {
                fileSize = Math.round(size / 1024 / 1024 / 1024 * 100) / 100; //单位为MB
                return fileSize + 'GB';
            }
            else if (fileSize > 1024) {
                fileSize = Math.round(size / 1024 / 1024 * 100) / 100; //单位为MB
                return fileSize + 'MB';
            }
            return fileSize + 'KB';
        }


        function readySync(file) {
            return new Promise(function (resolve, reject) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function (event) {
                    var data = {
                        url: this.result,
                        param: file
                    }
                    resolve(data);
                }
            });
        }

        function uploadSync(obj, form, param) {
            return new Promise(function (resolve) {
                var xhr = new XMLHttpRequest();
                var ot;
                var oloaded;
                xhr.onreadystatechange = function () {
                    // console.dir(xhr);
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        if (xhr.responseText) {
                            param.data = JSON.parse(xhr.responseText);
                            console.dir(param.data);
                            resolve(param.data);
                        }
                    }
                };
                // xhr.open("post", 'http://172.16.4.100:6280/uni/FileService/UploadFile', true);
                //  xhr.open("post", 'http://163.177.111.135:8100/uni/FileService/UploadFile', true);
                //      xhr.open("post", 'http://10.117.156.84:8078/uni/FileService/UploadFile', true);
               //前端上传党徽的
                xhr.open("post", 'http://183.6.145.106:8666/uni/FileService/UploadFile', true);

                // xhr.open("post", 'http://172.16.4.249:8400/uni/FileService/UploadFile', true);
                // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8;");
                xhr.timeout = 0;
                // xhr.onload = uploadComplete; //请求完成
                xhr.onerror = uploadFailed; //请求失败
                xhr.upload.onprogress = function (evt) {
                    var $fileItem = obj.find('.upload-files-item[file-name="' + param.fileName + '"]');
                    var $percentageDiv = $fileItem.find('.progress-bar-success');
                    //上传速度计算
                    var speed = getFileSize(perload / pertime);
                    $fileItem.find('.u-p-speed').text(speed + '/s');
                    // event.total是需要传输的总字节，
                    // event.loaded是已经传输的字节。
                    // 如果event.lengthComputable不为真，则event.total等于0
                    if (evt.lengthComputable) {//
                        var pross = Math.round(evt.loaded / evt.total * 100);
                        $percentageDiv.css('width', pross + "%");
                        if (pross == 100) {
                            $percentageDiv.text("上传成功");
                            $fileItem.find('.u-p-speed').text('上传完成');
                        } else {
                            $percentageDiv.text(pross + "%");
                        }
                    }
                    var time = document.getElementById("time");
                    var nt = new Date().getTime();//获取当前时间
                    var pertime = (nt - ot) / 1000; //计算出上次调用该方法时到现在的时间差，单位为s
                    ot = new Date().getTime(); //重新赋值时间，用于下次计算

                    var perload = evt.loaded - oloaded; //计算该分段上传的文件大小，单位b
                    oloaded = evt.loaded;//重新赋值已上传文件大小，用以下次计算


                };
                xhr.upload.onloadstart = function () {//上传开始执行方法
                    ot = new Date().getTime();   //设置上传开始时间
                    oloaded = 0;//设置上传开始时，以上传的文件大小为0
                };
                xhr.send(form);
            });
        }

        function removeEmpty(arr) {
            var newArr = [];
            for (var i in arr) {
                if (arr[i]) {
                    newArr[newArr.length] = arr[i];
                }
            }
            return newArr;
        }

        function appendHtml($parent, file) {
            if (!file) {
                return;
            }
            var $fileItemHtml = $parent.find('.upload-files-item.hide').clone();
            $fileItemHtml.attr('file-name', file['name']);
            $fileItemHtml.find('.u-p-img img').attr('src', file['url']).height(50);//(file['height']);
            $fileItemHtml.find('.u-p-name input').val(file['name']).attr('file-name', file['name']);
            $fileItemHtml.find('.progress').attr('file-name', file['name']);
            $fileItemHtml.find('.u-p-size').attr('size', file['size']).html(getFileSize(file['size']));
            $fileItemHtml.find('.upload-files-delete-s-btn').show().attr('file-name', file['name']).siblings('.upload-files-loading').hide();
            $fileItemHtml.removeClass('hide');
            $fileItemHtml.appendTo($parent.find('.upload-files-box'));
        }

        //初始化上传控件
        //加载已有文件
        $('.upload-files-main').each(function () {
            var $this = $(this);
            var data = $this.find('.files-data').html();
            if (data) {
                var fileList = JSON.parse(data);
                var parentName = $this.attr('name');
                // layoutFiles[parentName] = fileList;
                resultFiles[parentName] = fileList;
                for (var i in fileList) {
                    var item = {};
                    item = fileList[i];
                    // item.height = $this.data('p-height');
                    appendHtml($this, item);
                }
            }
            var accept = $this.data('accept'),
                multiple = $this.data('multiple'),
                maxCount = $this.data('max-count');
            if (accept != undefined && accept.length) {
                $this.find('input[type="file"]').attr('accept', accept);
            }
            if (multiple != undefined && multiple == false) {
                $this.find('input[type="file"]').removeAttr('multiple');
            }
            if (maxCount != undefined) {
                $this.find('input[type="file"]').attr('data-max-count', maxCount);
            }
        });
        //添加文件
        $(document).on('click', '.upload-files-file', function () {
            var $parent = $(this).parents('.upload-files-wrapper');
            if ($parent.find('.upload-files-item').not('.hide').length >= $(this).data('max-count')) {
                alert('最多只能上传' + $(this).data('max-count') + '个文件，请调整后重试');
                return false;
            }
        });
        //选择文件
        $(document).on('change', '.upload-files-file', function () {
            var $this = $(this);
            var $parent = $this.parents('.upload-files-wrapper');
            var parentName = $parent.parent().attr('name');
            var height = $parent.parent().data('p-height');
            var fileArr = layoutFiles[parentName];
            var uploadedFileArr = layoutFiles[parentName + '_uploaded'];
            var notFileArr = [];
            if (!fileArr) {
                fileArr = [];
            }
            var files = $(this).prop('files');
            var existFlag = false;
            for (var i = 0; i < files.length; i++) {
                var item = files[i];
                if (!validateFiles($(this).attr('accept'), item)) {
                    notFileArr[notFileArr.length] = item['name'];
                    continue;
                }
                //
                if (!existFiles(fileArr, uploadedFileArr, item)) {
                    existFlag = true;
                    continue;
                }
                if (item.size > 1024 * 1024 * 1024) {
                    alert('暂不支持上传大于1G的文件');
                    continue;
                }
                fileArr[fileArr.length] = item;
                //非图片不预览，大于5M的文件不预览
                if (previewImg(item['name']) && item['size'] < 5 * 1024 * 1024) {
                    readySync(item).then(function (result) {
                        var srcPath = result.url;//event.target.result;
                        var src = '/content/img/file.png';
                        if (validateImg(srcPath)) {
                            src = srcPath;
                        }
                        var file = result.param;
                        file.height = height;
                        file.url = src;
                        appendHtml($parent, file);
                    });
                } else {
                    item.url = '/content/img/file.png';
                    appendHtml($parent, item);
                }
            }
            layoutFiles[parentName] = fileArr;
            if (notFileArr.length) {
                alert('以下文件格式暂不支持上传：' + notFileArr.join(' | '));
            }
            if (existFlag) {
                alert('部分文件已存在');
            }
            //直接上传
            if ($this.parents('.upload-files-main').data('straight') == '1') {
                setTimeout(function () {
                    __uploadFiles($parent);
                }, 500);
            }
        });

        //上传文件
        $(document).on('click', '.upload-files-submit-btn', function () {
            $(this).attr('disabled', true);
            __uploadFiles($(this).parents('.upload-files-wrapper'));
            $(this).removeAttr('disabled');
            return false;
        });

        /**
         * 上传文件方法
         * @param obj 父级元素
         * @private
         */
        function __uploadFiles(obj) {
            var $parent = obj;
            var parentName = $parent.parent().attr('name');
            var fileArr = layoutFiles[parentName];
            var resultArr = resultFiles[parentName];
            if (!resultArr) {
                resultArr = [];
            }
            if (fileArr && fileArr.length) {
                var uploadedFileArr = layoutFiles[parentName + '_uploaded'];
                if (!uploadedFileArr) {
                    uploadedFileArr = [];
                }
                for (var i = 0; i < fileArr.length; i++) {
                    if (!fileArr[i]) {
                        continue;
                    }
                    var fileName = fileArr[i]['name'];
                    var $fileItem = $parent.find('.upload-files-item[file-name="' + fileArr[i]['name'] + '"]');
                    var uploadName = $fileItem.find('.u-p-name input').val();
                    var fileSize = $fileItem.find('.u-p-size').attr('size');

                    var form = new FormData();
                    form.append("name", uploadName);
                    // form.append("fileSize", fileSize);
                    form.append("file", fileArr[i]);
                    var param = {};
                    param.index = i;
                    param.fileName = fileName;
                    uploadSync($parent, form, param).then(function (result) {
                        //回调
                        resultArr.push(result.data.att);
                        resultFiles[parentName] = resultArr;
                        uploadedFileArr.push(fileArr[result.index]);
                        delete fileArr[result.index];

                        $parent.find('.upload-files-result').attr('name', parentName).val(JSON.stringify(resultArr));
                        layoutFiles[parentName] = removeEmpty(layoutFiles[parentName]);
                        layoutFiles[parentName + '_uploaded'] = uploadedFileArr;
                    });
                }
            }
            else {
                alert('请选择文件');
            }
        }

        function uploadComplete(rs) {
            console.dir(rs);
        }

        function uploadFailed(rs) {
            console.dir(rs);
        }


        //上传进度实现方法，上传过程中会频繁调用该方法
        // function
        //删除
        $(document).on('click', '.upload-files-delete-s-btn', function () {
            if (!confirm('确定要删除？')) {
                return;
            }
            var fileName = $(this).attr('file-name');
            var $parent = $(this).parents('.upload-files-wrapper');
            var parentName = $parent.parent().attr('name');
            var fileArr = layoutFiles[parentName];
            var newFileArr = [];
            if (fileArr && fileArr.length) {
                for (var i = 0; i < fileArr.length; i++) {
                    var item = fileArr[i];
                    if (item['name'] != fileName) {
                        newFileArr[newFileArr.length] = item;
                    }
                }
                layoutFiles[parentName] = newFileArr;
            }
            var resultArr = resultFiles[parentName];
            var newResultArr = [];
            if (resultArr && resultArr.length) {
                for (var k in resultArr) {
                    var item1 = resultArr[k];
                    if (item1['name'] != fileName) {
                        newResultArr[newResultArr.length] = item1;
                    }
                }
                resultFiles[parentName] = newResultArr;
                layoutFiles[parentName + '_uploaded'] = newResultArr;
                $parent.find('.upload-files-result').attr('name', parentName).val(JSON.stringify(newResultArr));
            }
            var $file = $parent.find('input[type="file"]');
            $file.after($file.clone().val(''));
            $file.remove();
            $(this).parents('.upload-files-item').remove();
        });

        //清空
        // $(document).on('click', '.upload-files-delete-btn', function () {
        //     if (!confirm('确定要清空未上传的文件？')) {
        //         return false;
        //     }
        //     var $parent = $(this).parents('.upload-files-wrapper');
        //     var parentName = $parent.parent().attr('name');
        //     layoutFiles[parentName] = [];
        //     $parent.find('.upload-files-item[uploaded!="1"]').not('.hide').remove();
        // });
    }
);
