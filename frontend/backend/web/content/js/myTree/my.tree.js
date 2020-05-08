/**
 * Created by Mars on 2018-03-10.
 */

function initMyTree($obj, nodes, setting) {
    $obj.html(getMyTreeHtml(0, nodes, setting, $obj));
}
function getMyTreeHtml(level, nodes, setting, $obj) {
    var html = '<ul class="my_tree_ul ">';
    for (var i in nodes) {
        var item = nodes[i];
        var isNewWin = 0;
        if (setting && setting.noWin == undefined) {
            isNewWin = item.isNewWin;
        }
        var liCls = ' open ', aCls = ' fa-caret-down ';
        if (setting && setting.hideLevel != undefined && setting.hideLevel > 0 && level >= setting.hideLevel - 1) {
            liCls = ' close_tree ';
            aCls = ' fa-caret-right ';
        }
        html += '<li class="my_tree_li ' + liCls + '" data-id="' + item.id + '" data-sort="' + item.sort + '">';
        var flag = true;
        //只加载常规菜单（这里用了0作为常规菜单，以后避免用0，因为js的if判断值如果为0，返回结果是false）
        if (setting && setting.menuType != undefined && setting.menuType == 0 && item.menuType != 0) {
            flag = false;
        }
        if (flag) {
            var cls = '';
            if (setting && setting.defUrl && item.url == setting.defUrl) {
                cls = 'active';
            }
            html += '<a ' +
                'style="padding-left:' + (level * 18) + 'px" ' +
                'data-level="' + level + '" ';
            for (var key in item) {
                var val = item[key];
                if (key == 'children') {
                    continue;
                }
                var dataKey = enCodeConvert(key);
                html += ' data-' + dataKey + '="' + val + '" ';
            }
            html +=
                (isNewWin ? 'data-is-new-win="' + isNewWin + '" ' : '' ) +
                (setting && setting.filter && setting.filter.url ? 'data-filter-url="' + setting.filter.url + '" ' : '' ) +
                (setting && setting.filter && setting.filter.param ? 'data-filter-param="' + setting.filter.param + '" ' : '' ) +
                (setting && setting.noWin ? 'data-no-win="' + setting.noWin + '" ' : '' ) +
                'class="link ' + cls + '">' +
                '<span class="no_click button btn_caret fa ' + ((!item.children || !item.children.length || !hasNormalMenu(item.children, setting)) ? " " : aCls) + liCls + ' " ></span>';
            if (setting && setting.showCheckbox != undefined && setting.showCheckbox == true) {
                html += '<span class="no_click my_tree_checkbox fa func" ></span>';
            }
            html += '<span class="tex">' + item.name + '</span>';
            if (setting && setting.showRemove && setting.showRemove == 1) {
                html += '<span class="no_click button remove_tree func">x</span>';
            }
            if (setting && setting.showRowField != undefined) {
                var o_width = 100 - parseInt($($obj.data('head')).find('li[data-field="name"]').data('width'));

                html += '<samp class="my_tree_field_box" style="width:' + o_width + '%">';
                $($obj.data('head')).find('li').each(function () {
                    html += '<samp title="' + item[$(this).data('field')] + '" class="my_tree_field ' + $(this).data('field') + '" style="width:' + ($(this).data('width') / o_width * 100) + '%">';
                    if ($(this).data('field') != 'name' && $(this).data('field') != 'layoutOpt') {
                        html += item[$(this).data('field')];
                    }
                    html += '</samp>';
                });
                html += '</samp>';
            }
            html += '</a>';

        }
        if (item.children && item.children.length) {
            html += getMyTreeHtml(level + 1, item.children, setting, $obj);
        }
        html += '</li>';
    }
    html += '</ul>';
    return html;
}
function setFilterParam($e) {
    var $this = $e;
    var paramArr = $this.data('filter-param').split(',');
    for (var i in paramArr) {
        var item = paramArr[i];
        $('#ifm_main_content', parent.document).contents().find('.search_params[name="' + item + '"]')
            .val($this.data(enCodeConvert(item)));
        $('#ifm_main_content', parent.document).contents().find('.search_params[name="page"]').val(1);
    }
    window.parent.document.getElementById("ifm_main_content").contentWindow.goToSearch();
}
function enCodeConvert(str) {
    var charArr = str.split('');
    var result = [];
    for (var i in charArr) {
        var item = charArr[i];
        if (item === item.toUpperCase()) {
            result.push('-')
        }
        result.push(item.toLowerCase());
    }
    return result.join('');
}

function deCodeConvert(str) {
    var charArr = str.split('');
    var result = [];
    for (var i in charArr) {
        var item = charArr[i];
        if (item == '-') {
            continue;
        }
        if (i > 0 && charArr[i - 1] == '-') {
            result.push(item.toUpperCase());
        } else {
            result.push(item);
        }
    }
    return result.join('');
}
$(function () {
    $(document).on('click', '.my_tree .btn_caret', function (e) {
        $(this).parent().siblings('ul').slideToggle(200);
        $(this).toggleClass('fa-caret-right').toggleClass('fa-caret-down');
    });
    $(document).on('click', '.my_tree a', function (e) {
        var $this = $(this);
        $this.parents('.my_tree').find('a').removeClass('active');
        $this.addClass('active');
        // if (!$(e.target).hasClass('func') && $(e.target).hasClass('button')) {
        //     $this.siblings('ul').slideToggle(200);
        // }
        if (!$(e.target).hasClass('no_click')) {
            if ($this.data('no-win') != 1 && $this.data('is-new-win') == 1) {
                openFullWindow($this.data('url'));
            } else if ($this.data('filter-param')) {
                // var $main = $('#ifm_main_content', parent.document);
                // var orgSrc = $main.attr('src');
                window.parent.layoutLoading();
                setFilterParam($this);
                // $main.attr('src', $this.data('filter-url') + '?' + getFilterParam($this, orgSrc));
            }
        }
    });
    $('.my_tree').attr('onselectstart', 'return false');
    //生成下拉框
    $('.select-tree').each(function () {
        var $this = $(this);
        var id = $this.data('val').toString();
        $this.attr('autocomplete', 'off');
        $this.parent().append('<input class="app_name" type="hidden" name="' + $this.data('name') + '" value="' + id + '">');
        // if ($this.data('other-param')) {
        //     var params = $this.data('other-param').split(',');
        //     for (var i in params){
        //         var item = params[i];
        //         $this.parent().append('<input class="app_other_name" type="hidden" name="' + item + '" value="' + id + '">');
        //     }
        // }
        $this.parent().append('<div class="select-tree-option my_tree" style="width:' + $this.outerWidth() + 'px"></div>');
        var $option = $this.siblings('.select-tree-option');
        initMyTree($option, JSON.parse($('#' + $this.data('tree-data')).text()), {noWin: 1, allShow: 1, hideLevel: 2});
        if (id) {
            $this.val($option.find('a[data-id="' + id + '"]').data('text'));
        }
    });
    $(document).on('keydown', '.select-tree', function (e) {
        if (e.keyCode != 116) {
            return false;
        }
    });
    $(document).on('click', '.select-tree', function () {
        var $next = $(this).siblings('.select-tree-option');
        $next.slideToggle(200);
        $next.find('a').removeClass('active');
        var $curr = $next.find('a[data-id="' + $(this).prev().val() + '"]');
        if ($curr.length) {
            $curr.addClass('active');
            $next.scrollTop($curr.position().top);
        }
    });
    $('body').click(function (e) {
        var $obj = $(e.target);
        if (!$obj.parents('.select-tree-option').length && !$obj.hasClass('select-tree')) {
            $('.select-tree-option').slideUp(200);
        }
    });
    //下拉框点击
    $(document).on('click', '.select-tree-option.my_tree a', function (e) {
        var $this = $(this);
        var $option = $this.parents('.select-tree-option');
        $option.siblings('.select-tree').siblings('.app_name').val($this.data('id'));
        var param = $option.siblings('.select-tree').data('other-param');
        if (param) {
            var params = param.split(',');
            for (var i in params) {
                var item = params[i];
                $option.siblings('input[name="' + item + '"]').val($this.data(enCodeConvert(item)));
            }
        }

        $option.siblings('.select-tree').val($this.data('text'));
        try {
            // $option.prev().prop('data-val', $this.data('id'));
            var field = $option.siblings('.select-tree').attr('name');
            //status	String	Can be NOT_VALIDATED, VALIDATING, INVALID or VALID
            $('form').data('bootstrapValidator')
                .updateStatus(field, 'VALID')
                .validateField(field);
        } catch (e) {

        }
        if (!$(e.target).hasClass('button')) {
            $option.slideUp(200);
        }

    });

    //复选框点击
    $(document).on('click', '.my_tree_org .my_tree_checkbox', function () {
        var $this = $(this);
        $this.toggleClass('fa-check');
        if ($this.hasClass('fa-check')) {
            $this.parent().siblings('ul').find('.my_tree_checkbox').addClass('fa-check');
            $this.parents('ul').siblings('a').find('.my_tree_checkbox').addClass('fa-check');
        } else {
            $this.parent().siblings('ul').find('.my_tree_checkbox').removeClass('fa-check');
        }
    });

    //复选框点击
    $(document).on('click', '.my_tree_clone .my_tree_checkbox', function () {
        var $this = $(this);
        $this.toggleClass('fa-check');
        if ($this.hasClass('fa-check')) {
            $this.parent().siblings('ul').find('.my_tree_checkbox').addClass('fa-check');
            $this.parents('ul').siblings('a').find('.my_tree_checkbox').addClass('fa-check');
        } else {
            $this.parent().siblings('ul').find('.my_tree_checkbox').removeClass('fa-check');
        }
        changeCheck($this);
    });

    function changeCheck($this) {
        if (!$this.parents('.my_tree').length) {
            return;
        }
        var allCheck = true;
        $this.parent().parent().parent().children('li').each(function () {
            // console.dir($(this).html());
            if (!$(this).children('a').children('.my_tree_checkbox').hasClass('fa-check')) {
                allCheck = false;
            }
        });
        if (allCheck) {
            $this.parent().parent().parent().siblings('a').find('.my_tree_checkbox').addClass('fa-check');
        } else {
            $this.parent().parent().parent().siblings('a').find('.my_tree_checkbox').removeClass('fa-check');
        }
        changeCheck($this.parent().parent().parent().siblings('a').find('.my_tree_checkbox'));
    }

});