<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<?php ?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<title><?php echo (($page_title)?($page_title):"米同营销搜索营销管理后台"); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
<meta name="description" content="mitong">
<meta name="author" content="mitong">


<script type="text/javascript">
<!--
	var ROOT      		= '__ROOT__';
  	var URL       		= '__URL__';
  	var APP       		= '__APP__';
  	var GROUP 			= '__GROUP__';
  	var ACTION_NAME   	= '<?php echo ACTION_NAME; ?>';
  	var MODULE_NAME   	= '<?php echo MODULE_NAME; ?>';
  	var PUBLIC      	= '__PUBLIC__';
  	var APP_PUBLIC    	= '../Public/';
  	var CURL      		= '<?php echo ($CURRENT_URL); ?>';
  	var PREURL      	= '<?php echo ($PRE_URL); ?>';
  
//-->
</script>

<!-- HTML5 for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="__PUBLIC__/js/html5shiv.js"></script>
<![endif]-->

<!-- ================================= load js begin =================================> -->
<!-- 引入jQuery -->
<script type="text/javascript" src="__PUBLIC__/js/jquery/jquery.1.10.2.min.js"></script>
<!-- 引入 layer 框架  -->
<script type="text/javascript" src="__PUBLIC__/js/layui/layui.js"></script>
<!-- underscore工具库   -->
<script type="text/javascript" src="__PUBLIC__/js/underscore/underscore-min.js"></script>
<!-- 系统公共js  -->
<script type="text/javascript" src="__PUBLIC__/js/common.js"></script>


<!-- ================================= load css begin =================================> -->
<!-- 引入bootstrap css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap.min.css?v=v3.3.7">
<!-- 引入 layui css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/layui/css/layui.css?v=1.0.9">
<!-- 引入系统  css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/demo3.css" type="text/css">
<!-- 引入图标字体  css -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/iconfont/iconfont.css?v=1.0.0" media="all">
<!-- 引入通用样式 css-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/common.css">
<!-- 引入通用缩写样式 css-->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/short.css">
<!-- 引入重写样式 -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/reset.css" >
<!-- 引入重写样式 -->
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/reset-layui.css" >
<script type="text/javascript">
//隐藏父页面的加载进度层
// $('#loading_iframe', parent.document).show();
</script>

<!-- tips插件 begin -->
<link rel="stylesheet" href="../Public/css/tipso.min.css">
<script type="text/javascript" src="../Public/js/tipso.min.js"></script>
<!-- tips插件 end -->

<!-- 引入 echarts begin -->
<script type="text/javascript" src="__PUBLIC__/js/echarts/echarts.js"></script>  
<!-- 引入 echarts end -->

<link rel="stylesheet" href="../Public/css/home.css">

<script type="text/javascript">
	$(function() {
		
		// 隐藏父页面的加载进度层
		$('#loading_iframe', parent.document).hide();
		
		// 初始化echarts
		init_chart();
		$(window).resize(function () {          //当浏览器大小变化时
			init_chart();
		});
		
        // 提示弹出初始化
		$('.tip').tipso({

			position : 'top',
			useTitle: false

		});
	});
	
	function init_chart(){

        // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main'));
		var consumptions_last_month = <?php echo ($consumptions_last_month); ?>;
		var consumptions_this_month = <?php echo ($consumptions_this_month); ?>;
        // 指定图表的配置项和数据
        
        
        var option = {
       	    title: {
       	        text: '每日消费（元）',
       	        left: 'center',
                   top: 10
       	    },
       	    tooltip : {
       	        trigger: 'axis',
       	        /* axisPointer: {
       	            type: 'cross',
       	            label: {
       	                backgroundColor: '#6a7985'
       	            }
       	        } */
       	    },
       	    legend: {
       	    	data:['上月消费','本月消费'],
                left: 'left',
       	    },
       	 	toolbox: {
	 	        show : true,
	 	        feature : {
	 	            mark : {show: true},
	 	            dataView : {show: true, readOnly: false},
	 	            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
	 	            restore : {show: true},
	 	            saveAsImage : {show: true}
	 	        }
	 	    },
	    	calculable : true,
       	    grid: {
       	    	 left: '1%',
                 right: '3%',
                 bottom: '5%',
                 top: 80,
                 containLabel: true
       	    },
       	    xAxis : [
       	        {
   	            type : 'category',
   	            // boundaryGap : false,
   	            data:<?php echo ($days); ?>,
   	            axisLabel: {
                       interval:0,//横轴信息全部显示
                     //  rotate: 60,//60度角倾斜显示
                      
                   }
       	        }
       	        
                  
       	    ],
       	    yAxis : [
       	        {
       	        	type : 'value',
	       	        axisLabel: {
	                    formatter: '{value}元'
	                }
       	        }
       	    ],
       	    series : [
       	        {
       	        	name: '上月消费',
       	            type:'line',
       	            //areaStyle: {normal: {}},
       	            data: consumptions_last_month,
       	            symbolSize: 8,//拐点大小
                    label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					
				 /* 	markPoint : {
				 		data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },  */
		            markLine : {
		                data : [
		                    {type : 'average', name : '平均值'}
		                ]
		            }
			            
       	        },
       	        {
       	        	name: '本月消费',
       	        	type:'line',
       	            //areaStyle: {normal: {}},
       	            data: consumptions_this_month,
       	            symbolSize: 8,//拐点大小
                    label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					/* markPoint : {
				 		data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },  */
					markLine : {
		                data : [
		                    {type : 'average', name : '平均值'}
		                ]
		            }
       	        }
       	    ]
       	};

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        
        
        
     	// 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main2'));
        var standard_num_last_month = <?php echo ($standard_num_last_month); ?>;
		var standard_num_this_month = <?php echo ($standard_num_this_month); ?>;
		var option = {
       	    title: {
       	        text: '每日达标任务',
       	        left: 'center',
                   top: 10
       	    },
       	    tooltip : {
       	        trigger: 'axis',
       	        /* axisPointer: {
       	            type: 'cross',
       	            label: {
       	                backgroundColor: '#6a7985'
       	            }
       	        } */
       	    },
       	    legend: {
       	    	data:['上月达标','本月达标'],
              	left: 'left',
       	    },
	       	 toolbox: {
	 	        show : true,
	 	        feature : {
	 	            mark : {show: true},
	 	            dataView : {show: true, readOnly: false},
	 	            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
	 	            restore : {show: true},
	 	            saveAsImage : {show: true}
	 	        }
	 	    },
 	    	calculable : true,
       	    grid: {
       	    	 left: '1%',
                 right: '3%',
                 bottom: '5%',
                 top: 80,
                 containLabel: true
       	    },
       	    xAxis : [
       	        {
       	            type : 'category',
       	           // boundaryGap : false,
       	            data:<?php echo ($days); ?>,
       	            axisLabel: {
                           interval:0,//横轴信息全部显示
                         //  rotate: 60,//60度角倾斜显示
                          
                       }
       	        }
       	        
                  
       	    ],
       	    yAxis : [
       	        {
       	            type : 'value'
       	        }
       	    ],
       	    series : [
       	        {
       	        	name: '上月达标',
       	            type:'line',
       	         	data: standard_num_last_month ,
       	            //areaStyle: {normal: {color:'#DDA490'}},
     	            symbolSize: 8,//拐点大小
					label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					itemStyle : {
	                     normal : {
	                         lineStyle:{
	                            width:3,//折线宽度
	                            color:"#DDA490"//折线颜色
	                         }
	                     }
	                },
	                /* markPoint : {
				 		data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },  */
		            markLine : {
		                data : [
		                    {type : 'average', name : '平均值'}
		                ]
		            }
       	        },
       	        {
       	        	name: '本月达标',
       	            type:'line',
       	         	data: standard_num_this_month,
       	           	// areaStyle: {normal: {color:'#B1D7C6'}},
     	            symbolSize: 8,//拐点大小
					label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					itemStyle : {
	                     normal : {
	                         lineStyle:{
	                            width:3,//折线宽度
	                            color:"#B1D7C6"//折线颜色
	                         }
	                     }
	                },
	                /* markPoint : {
				 		data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },  */
		            markLine : {
		                data : [
		                    {type : 'average', name : '平均值'}
		                ]
		            }
       	        }
       	    ]
       	};

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
        
     // 基于准备好的dom，初始化echarts实例
        var myChart = echarts.init(document.getElementById('main4'));
		var cons_months = <?php echo ($cons_months); ?>;
        // 指定图表的配置项和数据
        var option = {
       	    title: {
       	        text: '每月消费（元）',
       	        left: 'center',
                   top: 10
       	    },
       	    tooltip : {
       	        trigger: 'axis',
       	       
       	    },
       	    legend: {
       	    	data:['每月消费'],
                left: 'left',
       	    },
       	 	toolbox: {
	 	        show : true,
	 	        feature : {
	 	            mark : {show: true},
	 	            dataView : {show: true, readOnly: false},
	 	            magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
	 	            restore : {show: true},
	 	            saveAsImage : {show: true}
	 	        }
	 	    },
	    	calculable : true,
       	    grid: {
       	    	 left: '1%',
                 right: '3%',
                 bottom: '5%',
                 top: 80,
                 containLabel: true
       	    },
       	    xAxis : [
       	        {
   	            type : 'category',
   	            // boundaryGap : false,
   	            data:<?php echo ($months); ?>,
   	            axisLabel: {
                       interval:0,//横轴信息全部显示
                     //  rotate: 60,//60度角倾斜显示
                      
                   }
       	        }
       	        
                  
       	    ],
       	    yAxis : [
       	        {
       	        	type : 'value',
	       	        axisLabel: {
	                    formatter: '{value}元'
	                }
       	        }
       	    ],
       	    series : [
       	        {
       	        	name: '每月消费',
       	            type:'line',
       	            //areaStyle: {normal: {}},
       	            data: cons_months,
       	            symbolSize: 8,//拐点大小
                    label: {
						normal: {
							show: true,
							position: 'top'
						}
					},
					
				 /* 	markPoint : {
				 		data: [
		                    {type: 'max', name: '最大值'},
		                    {type: 'min', name: '最小值'}
		                ]
		            },  */
		            markLine : {
		                data : [
		                    {type : 'average', name : '平均值'}
		                ]
		            }
			            
       	        }
       	    ]
       	};

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
   
        
	}
	</script>
</head>
<body>

<!-- 页面顶部 logo & 菜单 begin  -->

<!-- header -->
<div class="ui-header">
	<?php load("@.file"); $logo_path = get_download_url($LoginUserInfo['oem_config']['logo_image_arr']['fileid']); ?>
	<div class="ui-header-logo fl">
    	<!-- <a class="logo" href="<?php echo U('Agent/Home/home');?>">
        <img src="<?php echo (($logo_path)?($logo_path):'__PUBLIC__/img/logo-white.png'); ?>" alt="">
      	</a> -->
	<div style="font-size:25px;text-align:center;line-height:63px;font-weight:bold;color:#fff;"><i class="iconfont">&#xe62f;</i>		<?php if($LoginUserName == '上海潮牛'): ?>潮牛网络
			<?php else: ?>
            <?php echo (title_show($LoginUserName)); endif; ?></div>
	</div>
	<div class="ui-header-main ta_r">
		<!-- <div class="menu-control-outer fl">
			<a href="#a_null" id="menuControl" class="menu-collapse-control" title="折叠菜单">
			</a>
		</div> -->
		<ul class="layui-nav header-link fr">
		  <li class="layui-nav-item">
		    <a href="javascript:;" title="<?php echo ($LoginUserName); ?>">欢迎您，<?php echo (title_show($LoginUserName)); ?></a>
		    <dl class="layui-nav-child">
		      <dd><a href="<?php echo U('User/updatePage');?>">账号信息</a></dd>
		      <dd><a href="<?php echo U('User/updatePasswordPage');?>">密码修改</a></dd>
		      <dd><a href="<?php echo U('Index/logOut');?>">安全退出</a></dd>
		    </dl>
		  </li>
		</ul>


		<div class="fl">
			<?php  $home_arra = array('Home','User','UserManagement','Finance','SysPermission'); ?>

			<a href="<?php echo U('Agent/Home/home');?>" class="header-link <?php if(in_array(MODULE_NAME,$home_arra)): ?>actived<?php endif; ?>">
				<i class="iconfont">&#xe671;</i>首页
			</a>

			<!-- 系统产品 begin -->
			<?php if(is_array($sys_products)): $i = 0; $__LIST__ = $sys_products;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="<?php echo U($vo['entry_code']);?>" class="header-link <?php if(in_array(MODULE_NAME,$vo['module_name_arra'][GROUP_NAME])): ?>actived<?php endif; ?>">
					<i class="iconfont"><?php echo ($vo['menuicon']); ?></i><?php echo ($vo['product_name']); ?>
				</a><?php endforeach; endif; else: echo "" ;endif; ?>


			<!-- 系统产品 end -->

			<a href="<?php echo U('Agent/Workorder/index');?>"  class="header-link <?php if(MODULE_NAME == 'Workorder'): ?>actived<?php endif; ?>">
				<i class="iconfont">&#xe6aa;</i>工单<?php if(($untreated_workorder_num) > "0"): ?><span class="badge"><?php echo ($untreated_workorder_num); ?></span><?php endif; ?>
			</a>
			<a href="<?php echo U('Agent/Question/index');?>"  class="header-link <?php if(MODULE_NAME == 'Question'): ?>actived<?php endif; ?>">
				<i class="iconfont">&#xe64c;</i>常见问题
			</a>


		</div>

	</div>
</div>
<!-- header end-->


<script>
layui.use(['element'], function(){
  var element = layui.element; //导航的hover效果、二级菜单等功能，需要依赖element模块
});
</script>
<!-- 页面顶部 logo & 菜单 end  -->

<!-- 页面左侧菜单 begin  -->
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
		<li class="layui-nav-item <?php if(MODULE_NAME == 'Index' && ACTION_NAME == 'index'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="<?php echo U('Index/index');?>"><i class="iconfont">&#xe60a;</i>产品概况</a>
		</li>
		
		<?php switch($LoginUserInfo['usertype']): case "customer_manager": ?><!-- 客服经理 -->
			<?php case "customer": ?><!-- 客服 -->
				<li class="layui-nav-item <?php if(MODULE_NAME == 'Site' && ACTION_NAME == 'index'): ?>layui-nav-itemed<?php endif; ?>">
			      <a href="<?php echo U('Site/index');?>">
			        <i class="iconfont f18">&#xe633;</i><span class="menu-title">站点管理</span>
			      </a>
			    </li><?php break;?>
		 	<?php default: endswitch;?>
			
		<li class="layui-nav-item <?php if(MODULE_NAME == 'Site' && ACTION_NAME == 'effect'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="<?php echo U('Site/effect');?>"><i class="iconfont">&#xe76a;</i>站点监控</a>
		</li>

		<!-- 关键词管理 begin -->
		<li class="layui-nav-item <?php if(MODULE_NAME == 'Keyword'): ?>layui-nav-itemed<?php endif; ?>">
			<a href="javascript:;"><i class="iconfont">&#xe699;</i>关键词管理</a>

			<dl class="layui-nav-child">
				<dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'search'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('Keyword/search');?>">关键词查询</a>
				</dd>
				<dd <?php if(MODULE_NAME == 'Keyword' && ACTION_NAME == 'effect'): ?>class="layui-this"<?php endif; ?>>
					<a href="<?php echo U('Keyword/effect');?>">关键词排名</a>
				</dd>
				
			</dl>
		</li>
		<!-- 关键词管理 end -->
	</ul>
	
</nav>
<!--menu 左侧菜单 end
<!-- 页面左侧菜单 end  -->

<!--内容区域 begin -->
<div class="ui-module">

<!-- 面包屑导航 begin -->
	<!-- <div class="ui-breadcrumb">
	  <span class="layui-breadcrumb" style="visibility: visible;">
	  <a href="javascript:void(0);">后台用户管理<span class="layui-box">&gt;</span></a><a href="javascript:void(0);"><cite>后台用户</cite></a></span>
	</div> -->
  	<!-- 面包屑导航 end -->
  	<div class="ui-content" id="ui-content" style="background: #ebf1f3">
		<div class="mt20">
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-blue" style="background: #7CCD7C">站点总数</div>
                    <div class="value">
                        <a data-parent="true" data-title="站点总数">
                          <h1><?php echo (($siteNum)?($siteNum): 0); ?></h1>
                     </a>

                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-commred" style="background: #708090" >关键词总数</div>
                    <div class="value">
                        <a data-parent="true" data-title="关键词总数">
                            <h1><?php echo (($purchasedKeywordNum)?($purchasedKeywordNum): 0); ?></h1>
                      </a>

                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-dark-green" style="background: #4F94CD">最新达标词数</div>
                    <div class="value">
                        <a data-parent="true" data-title="最新达标词数">
                            <h1><?php echo (($stankeywordNum)?($stankeywordNum): 0); ?></h1>
                     </a>

                    </div>
                </section>
            </div>
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-yellow-green" style="background: #00CED1">最新消费</div>
                    <div class="value">
                        <a  data-parent="true" data-title="最新消费">
                            <h1><?php echo (format_money($standardsFee)); ?></h1>
                      	
                      	</a>
                    </div>
                </section>
            </div>
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-orange" style="background: #C71585">冻结资金</div>
                    <div class="value">
                        <a data-parent="true" data-title="冻结资金">
                            <h1><?php echo (format_money($freezefunds)); ?></h1>
                      		
                      	</a>
                    </div>
                </section>
            </div>
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-yellow" style="background: #CD8C95">本月消费</div>
                    <div class="value">
                        <a data-parent="true" data-title="本月消费">
                            <h1><?php echo (format_money($consumption_month)); ?></h1>
                      	
                      	</a>
                    </div>
                </section>
            </div>
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-orange" style="background: #EE7621">累计消费</div>
                    <div class="value">
                        <a data-parent="true" data-title="累计消费">
                            <h1><?php echo (format_money($consumptionfunds)); ?></h1>
                      	
                      	</a>
                    </div>
                </section>
            </div>
            
            <div class="col-md-3">
                <section class="panel">
                    <div class="symbol bgcolor-orange">关键词达标率</div>
                    <div class="value">
                        <a data-parent="true" data-title="关键词达标率">
                            <h1><?php echo ($compliance_rate); ?></h1>
                      	
                      	</a>
                    </div>
                </section>
            </div>
		</div>
		<div class="clear"></div>     
		
        
        <div class="">
            <section class="panel">
                <div class="panel-heading">每日消费统计</div>
                <div class="panel-body">
                    <div class="echarts" id="main" style="height:400px;"></div>
                </div>
            </section>
        </div>
	
     	<div class="mt10">
             <section class="panel">
                 <div class="panel-heading">每日达标任务</div>
                 <div class="panel-body">
                     <div class="echarts" id="main2" style="height:400px;"></div>
                 </div>
             </section>
     	</div>
     	<!-- <div class="mt10">
             <section class="panel">
                 <div class="panel-heading">每日达标率</div>
                 <div class="panel-body">
                     <div class="echarts" id="main3" style="height:400px;"></div>
                 </div>
             </section>
        </div> -->
        <div class="mt10">
            <section class="panel">
                <div class="panel-heading">每月消费统计</div>
                <div class="panel-body">
                    <div class="echarts" id="main4" style="height:400px;"></div>
                </div>
            </section>
        </div>
	</div>
</div>
<!-- 页面底部 begin  -->
<div class="clear"> </div>

<div class="footer mt20" style="display: none;">
	<!-- <div class="ftleft">
		<p class="fl">
			<a href="/faq">常见问题</a> | <a href="/about">关于我们</a> | <a
				href="/contacts">联系我们</a> | <a href="/cooperation">商务合作</a>| <a
				href="#">网站地图</a> | <a href="/privacy">隐私申明</a> <br>
			400客服电话：400-902-8550 地址：上海市闵行区陈行公路2388号浦江科技广场5号楼5楼<br>
			推送者关键词快速排名系统-上海优槃网络科技有限公司旗下网站 <a href="http://www.miitbeian.gov.cn"
				target="_blank">沪ICP备16031230号-2</a>
		</p>
		<a href="/"><img src="/front/images/logo_white.png" alt=""
			class="fr"></a>
	</div> -->
</div>

<!-- 页面底部 end  -->
</body>
</html>