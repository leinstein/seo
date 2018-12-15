menu 左侧菜单 begin-->
<script type="text/javascript">
    $(function() {
        layui.use(['element'], function () {
            var element = layui.element

            window.$ = layui.jquery;
            // 监听导航点击
            element.on('nav(menu)', function (elem) {
                var mUrl = elem.attr('dx-menu');
                !_.isEmpty(mUrl) && _route.go(mUrl);
            });
        });
    });
</script>
<nav class="ui-menu">
    <ul class="layui-nav layui-nav-tree" lay-filter="menu">
        <!--    <li class="layui-nav-item <if condition="MODULE_NAME  eq 'System' && ACTION_NAME eq 'bpxdlist'">layui-nav-itemed</if>">
        <a href="{:U('System/bpxdlist')}"><i class="iconfont">&#xe76a;</i>霸屏下单</a>
        </li> -->

        <li class="layui-nav-item <if condition="MODULE_NAME  eq 'System' && ACTION_NAME eq 'bpxdlist'">layui-nav-itemed</if>">
        <a href="{:U('System/bpxdlist')}"><i class="iconfont">&#xe76a;</i>站点监控</a>
        </li>
        <li class="layui-nav-item <if condition="MODULE_NAME  eq 'System' && ACTION_NAME eq 'caseShow'">layui-nav-itemed</if>">
        <a href="{:U('System/caseShow')}"><i class="iconfont">&#xe76a;</i>案例展示</a>
        </li>

    </ul>

</nav>
<!--menu 左侧菜单 end