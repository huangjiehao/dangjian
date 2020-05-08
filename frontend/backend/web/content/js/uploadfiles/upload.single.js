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
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (event) {
                var data = {
                    url: this.result,
                    param: file
                };
                return data;
            }
        }

        function uploadSync(form, param) {

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
            $parent.find('.u-p-img img').attr('src', file['url']);//(file['height']);
        }

        //初始化上传控件
        //加载已有文件
        $('.upload-file-single-main').each(function () {
            var $this = $(this);
            var data = $this.find('.files-data').html();
            if (data) {
                $this.find('.upload-files-result').attr('name', $this.attr('name')).val(data);
                appendHtml($this, JSON.parse(data));
            }
            var accept = $this.data('accept');
            if (accept != undefined && accept.length) {
                $this.find('input[type="file"]').attr('accept', accept);
            }
        });
        //选择文件
        $(document).on('change', '.upload-file-single', function () {
            var $this = $(this);
            var $parent = $this.parents('.upload-files-wrapper');
            var files = $(this).prop('files');
            var item = files[0];
            if (!validateFiles($(this).attr('accept'), item)) {
                alert('不支持的文件格式');
                return false;
            }
            if (item.size > 1024 * 1024 * 1024) {
                alert('暂不支持上传大于1G的文件');
                return false;
            }
            //直接上传
            __uploadFiles($parent, files);
        });

        /**
         * 上传文件方法
         * @param obj 父级元素
         * @private
         */
        function __uploadFiles(obj, fileArr) {
            var $parent = obj;
            var parentName = $parent.parent().attr('name');
            var resultArr = resultFiles[parentName];

            //显示正在上传
            $parent.find('.upload-file-single-uploading').show();

            if (!resultArr) {
                resultArr = [];
            }

            var fileName = fileArr[0]['name'];
            var $fileItem = $parent.find('.upload-files-item[file-name="' + fileArr[0]['name'] + '"]');
            var uploadName = $fileItem.find('.u-p-name input').val();
            var fileSize = $fileItem.find('.u-p-size').attr('size');

            var form = new FormData();
            form.append("name", uploadName);
            // form.append("fileSize", fileSize);
            form.append("file", fileArr[0]);
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                // console.dir(xhr);
                if (xhr.readyState == 4 && xhr.status == 200) {
                    if (xhr.responseText) {
                        var result = JSON.parse(xhr.responseText);
                        //显示上传成功的图片
                        appendHtml($parent, result.data.att);
                        //设置返回值
                        $parent.find('.upload-files-result').attr('name', parentName).val(JSON.stringify(result.data.att));
                        //隐藏正在上传
                        $parent.find('.upload-file-single-uploading').hide();
                        //显示上传成功
                        $parent.find('.upload-file-single-uploaded').show();
                        setTimeout(function () {
                            //隐藏上传成功
                            $parent.find('.upload-file-single-uploaded').fadeOut(500);
                        }, 2000);
                    }
                }
            };
            xhr.open("post", 'http://fms0.gzdangjian.com/fms/FileService/UploadFile', true);
            xhr.onerror = uploadFailed; //请求失败
            xhr.send(form);

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