<?php

/**
 * 挂件：统计查询 搜索 挂件
 * {:W('StatisticsChart', array('data' => $yearList, 'type'=> 'year','title'=> '年度拨付情况分析','page' => 'index'))}
 * 
 * @copyright   Copyright 2010-2013 苏州德融嘉信信用管理技术有限公司(www.dejax.cn)
 * @package     Widget
 * @version     20130226
 * @link        http://www.dejax.cn
 */
class StatisticsChartWidget extends Widget{

	//渲染方法
    public function render($data){
		
    	//导入包
    	import("@.Org.Util.Chart");
    	    	
	$info 		= $data['data'];
    	
    	$type 		= $data['type'];
    	
    	$title 		= $data['title'];
    	
    	$charttype  = $data['data']['charttype'];
    	dump( $data['data']['charttype']);
    	
    	$page 		= $data['page'];
    	
    	$width 		= 960;//图表宽度
    	
    	$height 	= 380;//高度
    	
    	$data['statisticsStyle'] = 'statistics-detail';
    	if($page == 'index'){
    		
    		$width 		= 460;
    		
    		$height 	= 280;
    		
    		$data['statisticsStyle'] = 'statistics-index';
    		    		
    	}
    	//dump($data);
    	$charttype_array = explode('_',$charttype);
    	
    	//
    	if( strpos($charttype,'MSColumn') === 0 ||  strpos($charttype,'MSLine') ===0  ||  strpos($charttype,'MSBar') ===0  || strpos($charttype,'MSCombiDY') === 0 ){
    		
    		if(strpos($charttype,'MSBar') ===0){
    			
    			//$h = count($data['data']['data'][0]);
    			//dump($h);
    			
    			$chart = new Chart( "myChart_{$type}" , $charttype_array[0], $info['caption'], $info['data'], $height, $width );
    			
    			$array['isShowColorsBlock']  = 'no';
    			
    		}else
    			$chart = new Chart( "myChart_{$type}", $charttype_array[0], $info['caption'], $info['data'], $height ,$width);
    
    		$gethtml =  $chart-> getHtml($info,$charttype_array[1] );
    		
    		
    		$list['showchart'] =  $gethtml[0];
    		
    		$list['colors'] 	=  $gethtml[1];
    		
    		$list['values'] 	=  $info['data'][0];
    		
    	
    		$statisticsChart[]=  $list;
    		
    	}else if( strpos($charttype,'Pie') === 0 ){
    		
			if($page == 'index'){
				    		
				$width 		= 200;
				    		
				$height 	= 280;
				
				$info['pieRadius'] = 90;//饼状图大小
			    		 				
			}else{
				$width 		= 600;
				
				$height 	= 380;
				
				$info['pieRadius'] = 150;//饼状图大小
			}
    		
				$values	=  $info['data'][0];
				
				//删除下数值中地一个元素
				array_shift($values);
				
				//如果是并状态需要对数据进行重新整理;;计算百分比
				$total = 0; 
				
				foreach($values  as $key => &$vo) {
					
					$total += $vo;
					
				}
				
				
				foreach($values  as $key => &$vo1) {	
					
					$per =  100 * (sprintf("%.2f", ($vo1/$total)));
					
					//$new[$key]  = $values[$key] . "（占比 {$per}）";
					$new[$key]  =  $per;
					
				}
				
				
								
				$info['data'][0] = $new;
				
				//如果data数组是多为的
				if(count($vo['data']) > 1){
					
					foreach($vo['data'] as $key1=> $vo_data){
							
						$newdata[0] = $vo_data;
						
						//dump($vo['title_array'][$key1]);
						$chart = new Chart( "myChart_".$vo['title_array'][$key1], $charttype_array[0], $vo['title_array'][$key1], $newdata, "400", "900" );
						//dump($chart);

						$gethtml =  $chart-> getHtml( $vo['showNames'],$vo['showValues'],$vo['decimalPrecision'],$vo['formatNumberScale'],$vo['numberPrefix'],'',$charttype_array[1] );
						
						$showchart[] = $gethtml[0];
						//$data['colors'] =  $gethtml[1];
					}
					//$chart = new Chart( "myChart".($key+1), "Pie2D", $vo['title'], $vo_data, "350", "950" );
				}else{
					$chart = new Chart( "myChart_{$type}", $charttype_array[0], $info['caption'], $info['data'], $height ,$width);
					
					//$gethtml =  $chart-> getHtml( $vo['showNames'],$vo['showValues'],$vo['decimalPrecision'],$vo['formatNumberScale'],$vo['numberPrefix'],'','all');
					//dump($info);
					$gethtml =  $chart-> getHtml($info,$charttype_array[1] );
    		
    		
		    		$list['showchart'] =  $gethtml[0];
		    		
		    		$list['colors'] 	=  $gethtml[1];
		    		
		    		$list['values'] 	=  $values;
					//$data[''] =  $gethtml[1];
				}
				
			}
			
			
		$count = count($data['data']['data'][0]) - 1;
		$data['prompt_box_height'] 	=  $count * 20 ;
    	$data['statisticsChart'] 		=  $list ;
    	//获取BusinesstypeOptions
		//dump($data);
        $content = $this->renderFile('StatisticsChart',$data);
        return $content;  
    } 
}
?>