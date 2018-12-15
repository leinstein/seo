<!DOCTYPE html>
<html lang = "zh-CN">
<head>
    <include file = "../Public/header"/>
    <!-- 自定义正则验证js  -->
    <script src = "__PUBLIC__/js/regular.js"></script>
    <style>
        .sel_btn {
            height: 21px;
            line-height: 21px;
            padding: 0 16px;

            border: 1px #A5A5A5 solid;
            border-radius: 3px;
            color: black;
            display: inline-block;
            text-decoration: none;
            font-size: 14px;
            outline: none;
        }

        .ch_cls {
            background: #e4e4e4;
        }
    </style>

    <script type = "text/javascript">
        layui.use(['layedit'], function () {
            var layedit = layui.layedit;

            //构建一个默认的编辑器
            //var index = layedit.build('layer_textarea');
            //var index = layedit.build('layer_textarea', {
            // tool: ['strong','italic','underline','del', '|', 'left', 'center', 'right',
            //      '|','face', 'link', 'unlink']
            //});

            layedit.set({
                uploadImage: {
                    url: "{:U('Upload/doUpload1')}" //接口url
                    , type: '' //默认post
                }
            });
            //注意：layedit.set 一定要放在 build 前面，否则配置全局接口将无效。
            layedit.build('layer_textarea', {

                height: 500
            }); //建立编辑器
            //编辑器外部操作
            // var active = {
            //      content: function(){
            //        alert(layedit.getContent(index)); //获取编辑器内容
            //      }
            //      ,text: function(){
            //        alert(layedit.getText(index)); //获取编辑器纯文本内容
            //      }
            //      ,selection: function(){
            //        alert(layedit.getSelection(index));
            //      }
            //    };
            //
            //    $('.site-demo-layedit').on('click', function(){
            //      var type = $(this).data('type');
            //      active[type] ? active[type].call(this) : '';
            //    });

        });

    </script>
    <!-- 引入上传组件标签库 begin -->
    <taglib name = "dupload"/>
    <!-- 引入上传组件标签库 end -->
    <!-- 引入上传组件js和css文件 begin -->
    <dupload:script name = "dupload"/>
    <!-- 引入上传组件js和css文件 end-->

</head>
<body>
<!-- 页面顶部 logo & 菜单 begin  -->
<include file = "../Public/top_banner"/>
<!-- 页面顶部 logo & 菜单 end  -->

<!-- 页面左侧菜单 begin  -->
<include file = "../Public/left_miriadekeyword"/>
<!-- 页面左侧菜单 end  -->

<!--内容区域 begin -->
<div class = "ui-module">
    <div class = "ui-content"
         id = "ui-content">
        <div class = "ui-panel">
            <form class = "layui-form"
                  name = "update_form"
                  action = "__URL__/bpupdate"
                  enctype = "multipart/form-data"
                  method = "post">
                <input type="hidden" name="id" value="{$data['id']}">
                <div class = "layui-form-item">
                    <label class = "layui-form-label required">网站地址</label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;margin-left: 10px;">
                        <input type = "text"
                               name = "bp_site_url"
                               value = "{$data['bp_site_url']}"
                               placeholder = "请填写您的网站网址"
                               autocomplete = "off"
                               class = "layui-input">
                    </div>
                </div>

                <div class = "layui-form-item">
                    <label class = "layui-form-label required">联系电话</label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;margin-left: 10px;">
                        <input type = "text"
                               name = "bp_telephone"
                               value = "{$data['bp_telephone']}"
                               placeholder = "请填写您的手机号"
                               autocomplete = "off"
                               class = "layui-input">
                    </div>
                </div>

                <div class = "layui-form-item">
                    <!-- <label class="layui-form-label required">登录图片</label>-->
                    <label class = "layui-form-label required">营业2执照</label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;">
                        <dupload:upload
                                cannotedit = "login_page_image_arr['cannotedit']"
                                isimage = "login_page_image_arr['isimage']"
                                attachmentid = "login_page_image_arr['fileid']"
                                maxsize = "login_page_image_arr['maxsize']"
                                attachmentname = "login_page_image_arr['attachmentname']"
                                attachmenttype = "login_page_image_arr['attachmenttype']"
                                attachmentdesc = "login_page_image_arr['attachmentdesc']"
                                isrequire = "login_page_image_arr['isrequire']"
                                skin = "login_page_image_arr['skin']"
                                tagname = "login_page_image_arr['tagname']">
                        </dupload:upload>
                    </div>
                    <div class = "layui-form-mid layui-word-aux">请使用5M以内图片上传</div>
                </div>

                <div class = "layui-form-item">
                    <label class = "layui-form-label required">系统logo</label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;">
                        <dupload:upload
                                cannotedit = "loginpage_logo_image_arr['cannotedit']"
                                isimage = "loginpage_logo_image_arr['isimage']"
                                attachmentid = "loginpage_logo_image_arr['fileid']"
                                maxsize = "loginpage_logo_image_arr['maxsize']"
                                attachmentname = "loginpage_logo_image_arr['attachmentname']"
                                attachmenttype = "loginpage_logo_image_arr['attachmenttype']"
                                isrequire = "loginpage_logo_image_arr['isrequire']"
                                skin = "loginpage_logo_image_arr['skin']"
                                tagname = "loginpage_logo_image_arr['tagname']">
                        </dupload:upload>
                    </div>
                    <div class = "layui-form-mid layui-word-aux">请使用透明背景，白色字体logo，图片大小 180 * 60 (具体根据显示效果来定)</div>
                </div>

                <div class = "layui-form-item layui-form-text">
                    <label class = "layui-form-label required">相关附件</label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;">
                        <dupload:upload
                                cannotedit = "logo_image_arr['cannotedit']"
                                attachmentid = "logo_image_arr['fileid']"
                                maxsize = "logo_image_arr['maxsize']"
                                attachmentname = "logo_image_arr['attachmentname']"
                                attachmenttype = "logo_image_arr['attachmenttype']"
                                attachmentdesc = "logo_image_arr['attachmentdesc']"
                                isrequire = "logo_image_arr['isrequire']"
                                skin = "logo_image_arr['skin']"
                                tagname = "logo_image_arr['tagname']">
                        </dupload:upload>
                    </div>
                    <div class = "layui-form-mid layui-word-aux">请下载模板文档填写后上传</div>
                </div>

                <div class = "layui-form-item">
                    <label class = "layui-form-label "></label>
                    <div class = "layui-input-inline"
                         style = "width: 50%;">
                        <a class = "sel_btn  ch_cls"
                           href = "/Manage/Upload/downloadFile/id/34">点击下
                            载模板文档</a>
                    </div>

                </div>

                <div class = "layui-form-item">
                    <label class = "layui-form-label required">套餐类型</label>
                    <div class = "layui-input-inline">
                        <select first = "请选择套餐种类"
                                name = "bp_combo">
                            <option value = "1">12800/季度</option>
                            <option value = "2">20000/半年</option>
                            <option value = "3">30000/年</option>
                        </select>
                    </div>
                </div>

                <div class = "layui-form-item">
                    <div class = "layui-input-block">
                        <button class = "layui-btn"
                                lay-submit = ""
                                lay-filter = "go">下单
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- 页面底部 begin  -->
    <include file = "../Public/footer"/>
    <!-- 页面底部 end  -->

</body>
</html>
