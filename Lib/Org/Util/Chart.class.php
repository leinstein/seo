<?php
/**
 * Chart类 封装图表展示功能
 * 
 * @copyright   Copyright 2010-2011 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     ORG.Util
 * @version     201005
 * @link        http://www.qisobao.com
 */
class Chart    
{   
	//图表类型，所有支持的图表类型，请参考 fusioncharts 插件的文档说明，常用的图表类型有：Pie2D, Pie3D, MSLine2D, MSLine3D, MSColumn2D,MSColumn3D
	private $type = 'Pie2D';
	//生成图表的标题
	private $caption = '';
	//生成图表的显示标签id
	private $htmlId = 'myChartContainer';
	//生成图表的显示宽度
	private $height = '340';
	//生成图表的显示高度
	private $width = '480';
	//生成图表的背景颜色
	private $bgColor = 'FFFFFF';
	//数据格式
	private $dataFormat = 'XMLData';
	//数据，数据格式支持TP的数据集数组格式；
	private $data = null;
	/**
	 * 构造函数
	 */
    public function __construct( $htmlId, $type, $caption, $data, $height, $width, $bgColor ){
		//变量初始化
		if( $htmlId  )
			$this -> htmlId = $htmlId;
		if( $type  )	
			$this -> type = $type;
		if( $caption  )
			$this -> caption = $caption;
		if( $height  )
			$this -> height = $height;
		if( $width  )
			$this -> width = $width;
		if( $bgColor  )
			$this -> bgColor = $bgColor;
		if( $data  )
			$this -> data = $data;
    }
	
	/**
	 * 获得显示数据
	 */
    public function getData( $paraArray ,$type){
    	$showNames 			= $paraArray['showNames'];
    	$showValues 		= $paraArray['showValues'];
    	$decimalPrecision	= $paraArray['decimalPrecision'];
    	$formatNumberScale	= $paraArray['formatNumberScale'];
    	$numberPrefix		= $paraArray['numberPrefix'];
    	$numberSuffix		= $paraArray['numberSuffix'];
    	$outCnvBaseFontSize	= $paraArray['outCnvBaseFontSize'];; //$paraArray['outCnvBaseFontSize'];I('paraArray.outCnvBaseFontSize',14); 
    	$xAxisName			= $paraArray['xAxisName'];
    	$pieRadius 			= $paraArray['pieRadius'];//饼图直径
    	
    	
		/* if(!$outCnvBaseFontSize)
			$outCnvBaseFontSize = 14; */
    	switch ( $this->type ){
			case 'Pie2D':
			case 'Pie3D':
				if($type == 'all')
					$showValues = 0;
				else
					$showValues = 1;
					
				//饼图，只能处理单行数据
				$chartData = "<graph clickURL ='http://163.com' baseFontSize='14'  baseFontColor='000000'  outCnvBaseFontSize='".$outCnvBaseFontSize."' outCnvBaseFontColor='000000'   caption='".$this->caption."'  decimalPrecision='.$decimalPrecision.' bgColor='".$this->bgColor."' ";
				$chartData = $chartData."showPercentageValues='0' formatNumberScale='0' showNames='".$showNames."' showValues='".$showValues."'  showPercentageInLabel='0' "; 
				$chartData = $chartData."pieYScale='75' numberSuffix='％' chartTopMargin='10' pieBorderAlpha='410' pieFillAlpha='80' pieSliceDepth='15' pieRadius='".$pieRadius."'> ";
				
				foreach( $this->data as $vo ){
					foreach( $vo as $key => $val ){
						$color = $this-> getColor();
						if($type == 'all'){
							if($key != 'title')
								$colors[$key] = $color;
						}
						
						$chartData = $chartData."<set value='".$val."' name='".$key."' color='". $color ."'/>";
					}
					break;
				}							
				$chartData = $chartData."</graph>";
				$data['chartData'] = $chartData;
				$data['colors'] = $colors;
				break;
			case 'MSCombiDY2D'://双Y轴
				// $chartData = "<graph palette='2' caption='图表' rotateNames='0' showValues='0'  showNames='1' divLineDecimalPrecision='1' limitsDecimalPrecision='1' PYAxisName='价格' SYAxisName='数量' numberPrefix='$' formatNumberScale='0'>";
				
				/*  $chartData = " <graph palette='2' caption='销售的产品' subCaption='2009年10月' showValues='0' divLineDecimalPrecision='1' limitsDecimalPrecision='1' PYAxisName='金额' SYAxisName='数量' numberPrefix='￥' formatNumberScale='0' baseFont='Arial' baseFontSize='12' rotateYAxisName='1'>";
				$chartData .="<categories>";
				  $chartData .="<category label='A产品' />  <category label='B产品' />";
				  $chartData .="<category label='C产品' />";
				  $chartData .="<category label='D产品' />";
				  $chartData .="<category label='E产品' />";
				  $chartData .="<category label='F产品' />";
				  $chartData .="<category label='G产品' />";
				  $chartData .="<category label='H产品' />";
				 $chartData .="<category label='I产品' />";
				 $chartData .="<category label='J产品' />";
				  $chartData .="</categories>"; 
				  $chartData .="<dataset seriesName='收入'>";
				  $chartData .="<set value='5854' />";
				  $chartData .="<set value='4171' />";
				  $chartData .="<set value='1375' />";
				  $chartData .="<set value='1875' />";
				  $chartData .="<set value='2246' />";
				  $chartData .="<set value='2696' />";
				  $chartData .="<set value='1287' />";
				  $chartData .="<set value='2140' />";
				  $chartData .="<set value='1603' />";
				  $chartData .="<set value='1628' /> </dataset>";
				 
				  $chartData .="<dataset seriesName='利润' renderAs='Area' parentYAxis='P'>";
				  $chartData .="<set value='3242' />";
				  $chartData .="<set value='3171' />";
				  $chartData .="<set value='700' />";
				  $chartData .="<set value='1287' />";
				  $chartData .="<set value='1856' />";
				  $chartData .="<set value='1126' />";
				  $chartData .="<set value='987' />";
				  $chartData .="<set value='1610' />";
				  $chartData .="<set value='903' />";
				  $chartData .="<set value='928' /></dataset>";
				  
				  $chartData .="<dataset lineThickness='3' seriesName='数量' parentYAxis='S'>";
				  $chartData .="<set value='174' />";
				  $chartData .="<set value='197' />";
				  $chartData .="<set value='155' />";
				  $chartData .="<set value='15' />";
				  $chartData .="<set value='66' />";
				  $chartData .="<set value='85' />";
				  $chartData .="<set value='37' />";
				  $chartData .="<set value='10' />";
				  $chartData .="<set value='44' />";
				  $chartData .="<set value='322' />  </dataset>"; */
				
				//$chartData .=  "<categories><category label='20121110' /><category label='20121111' /><category label='20121112' /><category label='20121113' /><category label='20121114' /><category label='20121115' /><category label='20121116' /></categories>";
				/* $chartData .=  "<dataset renderAs='Line' parentYAxis='P' seriesName='Profit'>";
				$chartData .=  "<set value='3242' />";
				$chartData .=  "<set value='3171' />";
				$chartData .=  "<set value='700' />";
				$chartData .=  "<set value='1287' />";
				$chartData .=  "<set value='1856' />";
				$chartData .=  "<set value='987' />";
				$chartData .=  "<set value='1610' />";
				$chartData .=  "</dataset>";
				$chartData .=  "<dataset lineThickness='1' parentYAxis='S' seriesName='数量' >";
				$chartData .=  "<set value='174' />";
				$chartData .=  "<set value='197' />";
				$chartData .=  "<set value='155' />";
				$chartData .=  "<set value='15' />";
				$chartData .=  "<set value='66' />";
				$chartData .=  "<set value='85' />";
				$chartData .=  "<set value='37' />";
				$chartData .=  "</dataset>"; 
				$chartData .=  "</graph>";
				$data['chartData'] = $chartData;*/
				
				
				//折线图
				$chartData = "<graph palette='2'  baseFontSize='12' baseFontColor='000000' xAxisName ='{$xAxisName}'  PyAxisName ='{$paraArray['PyAxisName']}' SyAxisName ='{$paraArray['SyAxisName']}'  labelDisplay='ROTATE' toolTipBgColor='000000'  outCnvBaseFontSize='".$outCnvBaseFontSize."'  baseFontSize='14' outCnvBaseFontColor='000000' decimalPrecision='".$decimalPrecision."' showNames='".$showNames."' showValues='".$showValues."' numberPrefix ='".$numberPrefix."'   numberSuffix ='".$numberSuffix."' chartTopMargin ='10'   formatNumberScale='".$formatNumberScale."' caption='".$this->caption."'>";
				$chartData = $chartData . "<categories >";
				foreach( $this->data as $vo ){
					$i = 0;
					foreach( $vo as $key => $val ){
						if( $i > 0 ){
							if ( $val != "" ){
								$chartData = $chartData."<category name='" . $key . "' showName='1'/>";
							}else
								$chartData = $chartData."<category />";
						}
						$i ++;
					}
					break;
				}
				
				//dump(urlencode('吨'));
				$chartData = $chartData . "</categories>";
				foreach( $this->data as $key =>  $vo ){
					if($type != 'all'){
						$color = $this->getColor();
				
						//$colors[$key] = $color;
					}
					if($key == 0){
						$parentYAxis = 'P';
					}else
						$parentYAxis = 'S';
					$i = 0;
					foreach( $vo as $key => $val ){
				
						if($type == 'all'){
							;
							$color = $this->getColor();
							if($key != 'title')
								$colors[$key] = $color;
						}
						if( $i == 0 ){
							/* if($parentYAxis == 'P')
								$chartData = $chartData . "<dataset  numbersuffix ='1".urlencode($numberPrefix)."' seriesname='".$val."' color='". $color."' alpha='100' width='20'  renderAs='Area' parentYAxis='".$parentYAxis."' >";
							else
								$chartData = $chartData . "<dataset  numbersuffix ='e' seriesname='".$val."' color='". $color."' alpha='100' width='20'  renderAs='Area' parentYAxis='".$parentYAxis."' >"; */
							$chartData = $chartData . "<dataset   seriesname='".$val."' color='". $color."' parentYAxis='".$parentYAxis."' >";
						}else{
								
							if ( $val != "" )
								$chartData = $chartData.  "<set value='".$val."' color='".$color."'/>";
								
							else
								$chartData = $chartData.  "<set />";
						}
						$i ++;
					}
					$chartData = $chartData . "</dataset>";
				}
				
				$chartData = $chartData."</graph>";
				$data['chartData'] = $chartData;
				
				$data['colors'] = $colors;
				
				break;	
			case 'MSLine2D':
			case 'MSLine3D':
			case 'MSColumn2D':
			case 'MSColumn3D':
			case 'MSBar2D':
			case 'MSBar2D_all':
				
			case 'StackedBar':
			default:
				//折线图 
				$chartData = "<graph baseFontSize='12' baseFontColor='000000' xAxisName ='{$xAxisName}' yAxisMaxValue='{$paraArray['yAxisMaxValue']}' yAxisName='{$yAxisName}' labelDisplay='ROTATE' chartTopMargin ='20' canvasTopMargin= '1' toolTipBgColor='000000'  outCnvBaseFontSize='".$outCnvBaseFontSize."'  baseFontSize='14' outCnvBaseFontColor='000000' decimalPrecision='".$decimalPrecision."' showNames='".$showNames."' showValues='".$showValues."' numberPrefix ='".$numberPrefix."'  numberSuffix = '" . $numberSuffix ."'  formatNumberScale='".$formatNumberScale."' caption='".$this->caption."'>";
				$chartData = $chartData . "<categories >";
				foreach( $this->data as $vo ){
					$i = 0;
					foreach( $vo as $key => $val ){
						if( $i > 0 ){
							if ( $val != "" ){
									$chartData = $chartData."<category name='" . $key . "' />";
							}else
								$chartData = $chartData."<category />";
						}
						$i ++;
					}
					break;
				}	
				$chartData = $chartData . "</categories>";
				foreach( $this->data as $vo ){
					if($type != 'all'){
						$color = $this->getColor();
						
						//$colors[$key] = $color;
					}
					$i = 0;
					foreach( $vo as $key => $val ){
						
						if($type == 'all'){;
							$color = $this->getColor();
							if($key != 'title')
								$colors[$key] = $color;
						}
						if( $i == 0 ){
							$chartData = $chartData . "<dataset seriesname='".$val."' color='". $color."' alpha='100' width='20'>";
						}else{
							
							if ( $val != "" )
								$chartData = $chartData.  "<set value='".$val."' color='".$color."'/>";
							
							else
								$chartData = $chartData.  "<set />";
						}
						$i ++;
					}
					$chartData = $chartData . "</dataset>";
				}		

				$chartData = $chartData."</graph>";
			
				$data['chartData'] = $chartData;
				$data['colors'] = $colors;
		}
		return $data;
    }
    
	/**
	 * 获得外观脚本
	 */
    public function getHtml($paraArray , $type){
    	$data = $this->getData($paraArray,$type);
		$html = $html . "<div id='".$this->htmlId."' style='overflow: scroll-x;margin-left:10px;'>加载数据...</div>\n";
		$html = $html . "<script type='text/javascript'>\n";
		$html = $html . "var chartdata = \"".$data['chartData']."\";\n";
		$html = $html . "$('#".$this->htmlId."').insertFusionCharts({\n";
		$html = $html . "swfPath: '".__PUBLIC__."/js/fusioncharts/Charts/',\n";
        $html = $html . "type: '".$this->type."',\n";
		$html = $html . "data: chartdata,\n";
		$html = $html . "dataFormat: '".$this->dataFormat."',\n";       
		$html = $html . "width: '".$this->width."',\n";  		
		$html = $html . "height: '".$this->height."'\n";  				
		$html = $html . "});\n";  				
		$html = $html . "</script>\n"; 
		$return[] = $html;
		$return[] = $data['colors'];
		return $return;
    }
	
	/**
	 * 获得颜色
	 */
    public function getColor(){   
		for( $a=0; $a<6; $a++ ){    //采用#FFFFFF方法，   
			$d.=dechex(rand(0,15));//累加随机的数据，将十进制改为十六进制   
		}   
		return '#'.$d;   
	} 
}

?>