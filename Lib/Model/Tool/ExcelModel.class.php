<?php
/**
 * 模型层：excel文件操作模型类 
 *
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Model.Biz
 * @version     20141021
 * @link        http://www.qisobao.com
*/
class ExcelModel extends Model{
	/**
	 * 构造函数
	 */
	function _initialize() {
		//执行父类构造函数
		parent::_initialize();
		//合并自动完成
		$this->setProperty("_auto", array_merge($this->_auto, $this->__auto));		
	}
	
	/*自动处理数据*/
	protected $__auto 		= array (
		
	);
	
	/**
	 * 不检查数据库
	 */
	protected $autoCheckFields = false;
	
	/**
	 * 导入phpExcel核心类
	 */
	public function _import(){
		require_once './Core/Extend/Vendor/PHPExcel/PHPExcel.php';
		require_once './Core/Extend/Vendor/PHPExcel/PHPExcel/IOFactory.php';
		require_once './Core/Extend/Vendor/PHPExcel/PHPExcel/Writer/Excel5.php';
		require_once './Core/Extend/Vendor/PHPExcel/PHPExcel/Writer/Excel2007.php';
	}
	
	/**
	 * 获取Excel实例
	 *
	 * @author    weiwei.lu
	 * @version   201500804
	 * @copyright 上海启搜网络科技有限公司(www.qisobao.com)
	 * @link      http://www.qisobao.com
	 */
	public function getInstance($filePath){
		try {
			$this->_import();
			$objPHPexcel = PHPExcel_IOFactory::load($filePath);
			return $objPHPexcel;
		} catch (Exception $e) {
			return null;
		}
	}
	
	/**
	 * 初始化更新模板
	 *
	 * @author    weiwei.lu
	 * @version   20150821
	 * @copyright 上海启搜网络科技有限公司(www.qisobao.com)
	 * @link      http://www.qisobao.com
	 */
	public function writeData($objPHPexcel,$data){
		try{
			$this->_import();
			
			//修正Excel对象，对富文本（一个单元格中有多种样式混杂）的单元格处理
			$objPHPexcel=$this->correctRichText($objPHPexcel);
			
			foreach($data['data'] as $k => $v){
				$workSheet = $this->getSheetByMark($objPHPexcel, $k); //当前WorkSheet
				foreach($v as $cell => $val){
					if(is_numeric($val) && $val>'99999999999'){ //transfer num to string
						$workSheet->setCellValueExplicit($cell,$val,PHPExcel_Cell_DataType::TYPE_STRING);
					}else{
						$val = str_replace(' 00:00:00','',$val);
						$workSheet->getCell($cell)->setValue($val);
					}
				}
			}
			
			foreach($data['lock'] as $sheetmark => $cells){
				$workSheet = $this->getSheetByMark($objPHPexcel, $sheetmark); //当前WorkSheet
				foreach($v as $key => $cell){
					$workSheet->getStyle($cell)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_PROTECTED); //保护
				}
			}
			return $objPHPexcel;
			
		}catch(Exception $e){
			return null;//$e->getMessage();
		}
	}
	
	/**
	 * 修正Excel对象，对富文本（一个单元格中有多种样式混杂）的单元格处理
	 *（处理原因：富文本单元格  导出的Excel中格式跟原来模板不一致，发生了变化）
	 * @author    weiwei.lu
	 * @version   20150821
	 * @copyright 上海启搜网络科技有限公司(www.qisobao.com)
	 * @link      http://www.qisobao.com
	 */
	public function correctRichText($objPHPexcel){
		if($objPHPexcel){
			foreach ($objPHPexcel->getWorksheetIterator() as $worksheet) {//遍历工作表
				foreach ($worksheet->getRowIterator() as $row) {       //遍历行
					$cellIterator = $row->getCellIterator();   //得到所有列
					$cellIterator->setIterateOnlyExistingCells( false); // 跳过空列
					foreach ($cellIterator as $cell) {  //遍历列
						if (!is_null($cell)) {  //如果列不给空 
							//echo '        Cell - ' , $cell->getCoordinate() , ' - ' , $cell->getCalculatedValue() , PHP_EOL;
							$cellvalue=$cell->getValue();
							
							if($cellvalue instanceof PHPExcel_RichText){//对富文本单元格处理
								$arr=$cell->getValue()->getRichTextElements();
								foreach ($arr as $k=>$v){
									if(!($v instanceof PHPExcel_RichText_Run)){
										$text=$v->getText();
										$objText = $cellvalue->createTextRun($text);
										$objText ->setFont(clone $cell->getStyle()->getFont());
										$arr[$k]=$objText;
									}
								}
								$cellvalue->setRichTextElements($arr);
							}
						}
					}
				}
			}
		}
		return $objPHPexcel;
	}
	
	/**
	 * excel修改单个单元格内容
	 *
	 * @author    weiwei.lu
	 * @param   PHPExcel $objPHPexcel
	 * @param   String $k
	 * @param   String $cellNo
	 * @param   array $newValue
	 * @version   20150826
	 * @copyright 上海启搜网络科技有限公司(www.qisobao.com)
	 * @link      http://www.qisobao.com
	 */
	public function modifyCellValue($objPHPexcel,$k,$cellNo,$newValue){
		try{
			$this->_import();
			$workSheet = $this->getSheetByMark($objPHPexcel, $k); //当前WorkSheet
			$cellvalue=$workSheet->getCell($cellNo)->getValue();
			if($cellvalue instanceof PHPExcel_RichText ){//富文本单元格
				$arr=$cellvalue->getRichTextElements();
				foreach ($arr as $k=>$v){
					$v->setText($newValue[$k]);
				}
			}else{
				$newValue=implode("",$newValue);
				$workSheet->getCell($cellNo)->setValue($newValue);
				
			}
			return $objPHPexcel;
				
		}catch(Exception $e){
			return null;//$e->getMessage();
		}
	}
	
	
	/**
	 * excel隐藏行或列
	 *
	 * @author    weiwei.lu
	 * @version   20150804
	 * @copyright 上海启搜网络科技有限公司(www.qisobao.com)
	 * @link      http://www.qisobao.com
	 */
	public function hideRowOrColumn($objPHPexcel,$k,$no,$type="row"){
		try{
			$this->_import();
			$workSheet = $this->getSheetByMark($objPHPexcel, $k); //当前WorkSheet
			$no_arr=explode(",",$no);
			if($type=="row"){
				foreach ($no_arr as $k=>$vo){
					$workSheet->getRowDimension($vo)->setVisible(false);
				}
			}else if($type=="column"){
				foreach ($no_arr as $k=>$vo){
					$workSheet->getColumnDimension($vo)->setVisible(false);
				}
			}
			return $objPHPexcel;
	
		}catch(Exception $e){
			return null;//$e->getMessage();
		}
	}
	
	/**
	 * 下载Excel
	 *
	 * @author    weiwei.lu
	 * @version   201500804
	 * @copyright 上海启搜网络科技有限公司(www.qisobao.com)
	 * @link      http://www.qisobao.com
	 */
	public function downloadExcel($objPHPexcel,$fileName){
		try {
			$this->_import();
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
			$date = md5(date('Ymd-His'));
			//下载excel
			$outputFileName=str_replace(".xls","",$fileName).'.xls';
			//if(preg_match("/MSIE/", $ua)){//IE
				//$outputFileName = urlencode($outputFileName);
			//}
			
			//判断浏览器IE
			if( getBrowser() == 'ie' ){
				//将$filename中的中间空格去掉
				$outputFileName = str_replace(' ', '', $outputFileName );
				$outputFileName = urlencode($outputFileName);
			}
			
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename='.$outputFileName);
			header('Cache-Control: max-age=0');
			$objWriter->save("php://output");
		} catch (Exception $e) {
			return false;
		}
	}
	
	
	/**
	 * 重写Excel
	 *
	 * @author    weiwei.lu
	 * @version   201500908
	 * @copyright 上海启搜网络科技有限公司(www.qisobao.com)
	 * @link      http://www.qisobao.com
	 */
	public function overWriteExcel($baseStru,$filePath,$templetconf){
		try {
			$this->_import();
			$objPHPexcel=$this->getInstance($filePath);//获取服务器路径上Excel的实例
			
			foreach ($baseStru as $k=>$v){
				$workSheet = $this->getSheetByMark($objPHPexcel, $k); //当前WorkSheet
				foreach($v as $kk => $vv){
					$content=$vv['content'];
					$cell=$templetconf[$k][$kk]['cell'];
					//转换空格符和换行符  以及进行反转义
					$arr  = array("&nbsp;","<br>");
					$arr_2 =array(" ","\r\n");
					$content=stripslashes(stripslashes(str_replace($arr,$arr_2,$content)));
					
					if(preg_match("(^[A-Z][0-9]+$)",$cell)){
						if(substr($workSheet->getCell($cell)->getValue(),0,1)!="="){
							if(is_numeric($content) && $content>'99999999999'){ //transfer num to string
								$workSheet->setCellValueExplicit($cell,$content,PHPExcel_Cell_DataType::TYPE_STRING);
							}else{
								$val = str_replace(' 00:00:00','',$content);
								$workSheet->getCell($cell)->setValue($content);
							}
						}
					}
				}
			}
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
			//替换保存excel
			$objWriter->save($filePath);
		} catch (Exception $e) {
			return false;
		}
	}
	
	
	/**
	 * 载入excel
	 */
	public function getExcel($filePath ){
		$this->_import();

    	/*创建对象,读取excel文件*/
		$PHPExcel = new PHPExcel();
		
		/*默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/ 
		$PHPReader = new PHPExcel_Reader_Excel2007();
		if(!$PHPReader->canRead($filePath)){
			$PHPReader = new PHPExcel_Reader_Excel5(); 
			if(!$PHPReader->canRead($filePath)){
				//echo 'no Excel';
				return false;
			}
		}
    	
		$PHPReader->setReadDataOnly(true); //设置只读数据模式
  		$PHPExcel = $PHPReader->load($filePath); //载入excel
		
		return $PHPExcel;
	}
	
	/**
	 * 得到模板文件的block配置
	 */
	public function getDataBlockConf($PHPExcel, $allRow){
 		$dataBlockConf = array();
 		
 		//第一个block的配置
  		$dataBlockConf[0]["title"] = $this->getCellValue($PHPExcel, 2, 2);
  		if( $this->getCellValue($PHPExcel, 3, 3) == null ){
			$dataBlockConf[0]["type"] = "竖表";
		}else{ 
  			$dataBlockConf[0]["type"] = "横表";
  			$dataBlockConf[0]["maxCol"] = $this->getBlockMaxCol($PHPExcel,3);
  		}
  		$dataBlockConf[0]["startRow"] = 3;

  		//其他block的配置
 		$i = 1;
  		for($row = 3; $row <= $allRow; $row++){
			$data1 = $this->getCellValue($PHPExcel, 2, $row-1); //B列上一行的数据
			$data2 = $this->getCellValue($PHPExcel, 2, $row); //B列当前行的数据
			$data3 = $this->getCellValue($PHPExcel, 2, $row+1);//B列下一行的数据
			if(empty($data1) && !empty($data2) && !empty($data3)){
				$dataBlockConf[$i]["title"] = $data2;
				if( $this->getCellValue($PHPExcel, 3, $row+1) == null){
					$dataBlockConf[$i]["type"] = "竖表";
				}else{
					$dataBlockConf[$i]["type"] = "横表";
  					$dataBlockConf[$i]["maxCol"] = $this->getBlockMaxCol($PHPExcel,$row+1);
				}
				$dataBlockConf[$i]["startRow"] = $row+1;
				$dataBlockConf[$i-1]["endRow"] = $row-2;
				$maxBlock = $i++;
			}
  		}
 		
  		if($i==1)
  			$dataBlockConf[0]["endRow"] = $allRow;
  		else
  			$dataBlockConf[$maxBlock]["endRow"] = $allRow;
  		
  		//附带字段名的详细配置
  		foreach($dataBlockConf as $k => $config){
  			if($config['type']=='竖表'){
  				for($row = $config['startRow']; $row <= $config['endRow']; $row++){
  					$name = $this->getCellValue($PHPExcel, 2, $row);
  					$dataBlockConf[$k]['col'][$row] = $this->getNameStr($name);
  				}
  			}else{
  				$cols = 'C';
  				for($col = 2; $col <= $config['maxCol']; $col++){
  					$name = $this->getCellValue($PHPExcel, $col, $config['startRow']);
  					$dataBlockConf[$k]['col'][$cols] = $this->getNameStr($name);
  					$cols++;
  				}
  			}
  		}
  		return $dataBlockConf;
	}
	
	/**
	 * 得到上传文件的数据
	 */
	public function getDataObject($PHPExcel, $dataBlockConf, $allRow, $datatype ){
		$dataObject = array();
		
		$flg = $this->getCellValue($PHPExcel, 0, 1);
		$flag = $datatype.'_Dejax';
		if($flg != $flag){
			$dataObject = 'template_type';
		}else{
			for($row=2; $row<=$allRow; $row++){
				$title = $this->getCellValue($PHPExcel, 2, $row);
				foreach($dataBlockConf as $k => $v){
					if($title == $v["title"]){ //表名匹配
						$dataObject[$k]["title"] = $title;
						if($v["type"]=="竖表"){
							$dataObject[$k]["type"] = "竖表";
							//主键读取
							$valID = $this->getCellValue($PHPExcel, 0, $row+1);
							if($valID)
								$dataObject[$k]["data"]['ID'] = $valID;
							//数据读取
							for($_row=$v["startRow"]; $_row<=$v["endRow"]; $_row++){
								$name = $this->getCellValue($PHPExcel, 2, $_row);
								$name = $this->getNameStr($name);
								$val = $this->getCellValue($PHPExcel, 3, $_row);
								if(strstr($name,'日期') || strstr($name,'有效期至') ){ //“年月日”日期转换
									if(preg_match('/^\d{5,6}$/',$val))
										$val = $this->excelTime($val); //gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($val));//有2038年溢出问题
								}
								$dataObject[$k]["data"][$name] = $val;
							}
						}else{
							$nameArray = array();
							$dataObject[$k]["type"] = "横表";
							for($col=2; $col<=$v["maxCol"]; $col++ ){
								$nameArray[$col] = $this->getCellValue($PHPExcel, $col, $v["startRow"]);
								$nameArray[$col] = $this->getNameStr($nameArray[$col]);
							}
							$j = 0;
							for($_row=$v["startRow"]+1; $_row<=$v["endRow"]; $_row++ ){
								if( ($this->getCellValue($PHPExcel, 2, $_row))=="合计" ){
									//数据读取
									for($col=2; $col<=$v["maxCol"]; $col++ ){
										$name = $nameArray[$col];
										$val = $this->getCellFormulaValue($PHPExcel, $col, $_row);
										$dataObject[$k]["data"][$j][$name] = $val;
									}
									break;
								}else{
									//主键读取
									$valID = $this->getCellValue($PHPExcel, 0, $_row);
									if($valID)
										$dataObject[$k]["data"][$j]['ID'] = $valID;
									//数据读取
									for($col=2; $col<=$v["maxCol"]; $col++ ){
										$name = $nameArray[$col];
										$val = $this->getCellValue($PHPExcel, $col, $_row);
										if(strstr($name,'日期') || strstr($name,'有效期至') ){ //“年月日”日期转换
											if(preg_match('/^\d{5,6}$/',$val))
												$val = $this->excelTime($val); //gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($val));//有2038年溢出问题
										}
										$dataObject[$k]["data"][$j][$name] = $val;
										if($col==3){ //无效数据行
											if($val==null){
												unset($dataObject[$k]["data"][$j]);
												$j--;
												break;
											}
										}
									}
									$j++;
								}
							}
							if(empty($dataObject[$k]["data"]))
								$dataObject[$k]['colname'] = $nameArray;
						}
					}
				}
			}
		
		}
		return $dataObject;
	}
	
	/**
	 * 得到excel工作表个数
	 */
	public function getSheetCount($PHPExcel){
		return $PHPExcel->getSheetCount();
	}
	
	/**
	 * 得到excel工作表名称
	 */
	public function getSheetNames($PHPExcel){
		return $PHPExcel->getSheetNames();
	}
	
	/**
	 * 得到当前工作表信息
	 */
	public function getSheet($PHPExcel, $i = 0){
		return $PHPExcel->getSheet($i);
	}
	
	/**
	 * 得到excel有效数据的最大行
	 */
	public function getHighestRow($PHPExcel){
		return $PHPExcel->getHighestRow();
	}
	
	/**
	 * 得到excel单元格的数据
	 */
	public function getCellValue($PHPExcel, $col, $row){
		$data = $PHPExcel->getCellByColumnAndRow($col, $row)->getValue();
		return $this->removeSpace($data);
	}
	
	/**
	 * 得到excel单元格的公式的值
	 */
	public function getCellFormulaValue($PHPExcel, $col, $row){
		$data = $PHPExcel->getCellByColumnAndRow($col, $row)->getCalculatedValue();
		return $this->removeSpace($data);
	}
	
	/**
	 * 得到横表的列数
	 */
	public function getBlockMaxCol($PHPExcel, $row){
  		$col = 2;
  		while( $PHPExcel->getCellByColumnAndRow($col,$row)->getValue() != null ){
  			$maxCol = $col++;
  		}
		return $maxCol;
	}

	/**
	 * 去掉string的'*','：',' '
	 */
	public function getNameStr($string){
		$remove = array('*',':','：',' ');
		if($string){
			$string = str_replace($remove,'',$string);
			return $string;
		}else
			return false;
	}
	
	/**
	 * excel日期转换
	 */
	public function excelTime($date, $time = false){
		if(function_exists('GregorianToJD')){
			if(is_numeric( $date )) {
				$jd = GregorianToJD( 1, 1, 1970 );
				$gregorian = JDToGregorian( $jd + intval ( $date ) - 25569 );
				$date = explode('/', $gregorian);
				
				$date = str_pad( $date [2], 4, '0', STR_PAD_LEFT )
				."-". str_pad( $date [0], 2, '0', STR_PAD_LEFT )
				."-". str_pad( $date [1], 2, '0', STR_PAD_LEFT )
				. ($time ? " 00:00:00" : '');
				return $date;
			}
		}else{
			$date=$date>25568?$date+1:25569;
			/*There was a bug if Converting date before 1-1-1970 (tstamp 0)*/
			$ofs=(70 * 365 + 17+2) * 86400;
			$date = date("Y-m-d",($date * 86400) - $ofs).($time ? " 00:00:00" : '');
		}
		return $date;
	}
	
	/**
	 * 去空格和换行
	 *
 	 * @param     string $data 待处理数据
	 * @author    zhangss
	 * @copyright 上海启搜网络科技有限公司(www.qisobao.com)
	 * @package   Action
	 * @version   20150302
	 * @link      http://www.qisobao.com
	 */
	public function removeSpace($data){
		$arr = array('%0A','%0D','+');
		return urldecode(str_replace($arr, '', urlencode($data)));
	}
	
	
	/**
	 * 读取excel文件:专门为读取申报配置文件而写的方法
	 *
	 * 读取模式一：table模式-第一行是标题，其他的行是值
	 * 
	 * @param string $filePath：文件路径
	 * 
	 * @return array
	 */
	public function readForDeclareConfig( $filePath ){
		
		if(!file_exists($filePath)){
			$this -> error = '文件路径错误';
			return false;
		}
	
	
		header('Content-Type:text/html; charset=utf-8');
	
		//获取excel文件
		$PHPExcel 		= $this -> getExcel($filePath);
	
		//如果获取到了文件
		if( $PHPExcel ){
			//读取excel文件中的工作表*/
			$currentSheet 					= $PHPExcel -> getSheet( 0 );
			//取得最大的列号
			$allColumn 						= $currentSheet -> getHighestColumn();
			//取得一共有多少行
			$allRow 						= $currentSheet -> getHighestRow();
			
			//读取审批配配配置
			$approvalconfig['actioname'] 	= $currentSheet-> getCellByColumnAndRow(ord('A') - 65,'3')->getValue();
			$approvalconfig['processid'] 	= $currentSheet-> getCellByColumnAndRow(ord('B') - 65,'3')->getValue();
			$approvalconfig['processname'] 	= $currentSheet-> getCellByColumnAndRow(ord('C') - 65,'3')->getValue();
			$data['approvalconfig'] 		= $approvalconfig;
			
			//读取报送配置配置
			$reportconfig['templetconfid'] 	= $currentSheet-> getCellByColumnAndRow(ord('A') - 65,'6')->getValue();
			$reportconfig['tplname'] 		= $currentSheet-> getCellByColumnAndRow(ord('B') - 65,'6')->getValue();
			$data['reportconfig'] 			= $reportconfig;
			
			//读取电子材料配置
			for($currentRow = 11;$currentRow <= $allRow;$currentRow++){
				
				unset( $temp );
				$temp['name'] 				= $currentSheet-> getCellByColumnAndRow( ord('A') - 65 ,$currentRow )->getValue();
				$temp['require'] 			= $currentSheet-> getCellByColumnAndRow( ord('B') - 65 ,$currentRow )->getValue();
				$temp['needaudit'] 			= $currentSheet-> getCellByColumnAndRow( ord('C') - 65 ,$currentRow )->getValue();
				$temp['printfunc'] 			= $currentSheet-> getCellByColumnAndRow( ord('D') - 65 ,$currentRow )->getValue();
				$printfileconfig[] 			= $temp;
				
			}
			
			$data['printfileconfig'] = $printfileconfig;
			
		}
		
		return $data;
	}
	
	
	/**
	 * 通用方法:导出excel列表 
	 * 
	 * @param array $data 导出的数据 格式如：array(array('a','b',..),array('c','d',..),...)
	 *   例如：
	 *   array
			  0 => 
			    array
			      0 => int 1
			      1 => string '企业'
			      2 => string '苏州测试公司一'
			      3 => string '666812390'
			      4 => string '2016-04-15 15:29'
			      5 => string '待审核'
			      6 => string '未经法入库验证'
			      7 => string '管理员新增'
			      8 => string ''
      			  9 => null     	
	 * 
	 * @param string $filename 导出文件名
	 * @param string $excelTitle 表名以及标题
	 * @param array $columnTitles 表头 格式如：array('a','b',..)
	 * 	例如
		 array
				  0 => string '序号'
				  1 => string '单位类型'
				  2 => string '单位名称'
				  3 => string '组织机构代码'
				  4 => string '提交时间'
				  5 => string '审核状态'
				  6 => string '法人库验证状态
				  7 => string '来源'
				  8 => string '备注'
				  9 => string '审核意见'
	 * @param array $columnWidths 列宽 格式如：array('a','b',..)
		 例如
		 	array
				  0 => int 10
				  1 => int 20
				  2 => int 35
				  3 => int 20
				  4 => int 20
				  5 => int 10
				  6 => int 20
				  7 => int 40
				  8 => int 40
	 * @param array $columnAligns 对齐方式
	 */
	public function exportToExcel($data,$filename,$filepath,$excelTitle,$columnTitles,$columnWidths,$columnAligns) {
	
		$this->_import();
	
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->getProperties()->setCreator("ctos")
		->setLastModifiedBy("ctos")
		->setTitle("Office 2007 XLSX Test Document")
		->setSubject("Office 2007 XLSX Test Document")
		->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
		->setKeywords("office 2007 openxml php")
		->setCategory("Test result file");
		
		$maxColumnIndex=count($data[0])-1;
		$maxColumnString=PHPExcel_Cell::stringFromColumnIndex($maxColumnIndex<0?0:$maxColumnIndex);
		
		//根据配置设置每个列的宽度，如果没有默认设置为20
		for($i=0;$i<=$maxColumnIndex;$i++){
			if($columnWidths[$i]){
				$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($i)->setWidth($columnWidths[$i]);
			}else{
				$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn($i)->setWidth(20);
			}
		}
		
		// 设置行高度：第一行标题的高度
		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
		
		//第二行表列名的高度
		$objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
		
		// 字体和样式
		$objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);
		$objPHPExcel->getActiveSheet()->getStyle('A2:'.$maxColumnString.'2')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
	
		//$objPHPExcel->getActiveSheet()->getStyle('A2:'.$maxColumnString.'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//$objPHPExcel->getActiveSheet()->getStyle('A2:'.$maxColumnString.'2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		//$objPHPExcel->getActiveSheet()->getStyle('A2:'.$maxColumnString.'2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		//$objPHPExcel->getActiveSheet()->getStyle('A2:'.$maxColumnString.'2')->getFill()->getStartColor()->setARGB('00B0B0B0');
	
		// 设置水平居中
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		/*for($i=0;$i<=$maxColumnIndex;$i++){
			$objPHPExcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			if($columnAligns[$i]=="left"){
				$objPHPExcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			}else if($columnAligns[$i]=="center"){
				$objPHPExcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}else if($columnAligns[$i]=="right"){
				$objPHPExcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
			}else{
				$objPHPExcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($i))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
			}
		}*/
		
		//  合并
		$objPHPExcel->getActiveSheet()->mergeCells('A1:'.$maxColumnString.'1');	
		// 标题
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $excelTitle);
		
		//表头
		for($i=0;$i<=$maxColumnIndex;$i++){
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue(PHPExcel_Cell::stringFromColumnIndex($i).'2', $columnTitles[$i]);
		}
	
		// 内容
		foreach ($data as $k=>$row){
			foreach ($row as $kk=>$value){
				//$objPHPExcel->getActiveSheet()->getStyle(PHPExcel_Cell::stringFromColumnIndex($kk) . ($k + 3))->getAlignment()->setWrapText(true);
				//设置为文本格式
				$objPHPExcel->getActiveSheet(0)->setCellValueExplicit(PHPExcel_Cell::stringFromColumnIndex($kk) . ($k + 3), $value,PHPExcel_Cell_DataType::TYPE_STRING);
			}
		}
	
		// 设置 sheet的名称
		$objPHPExcel->getActiveSheet()->setTitle($excelTitle);
	
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		//判断浏览器IE
		if( getBrowser() == 'ie' ){
			//将$filename中的中间空格去掉
			$filename = str_replace(' ', '', $filename );
			$filename = urlencode($filename);
		}
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		
		if($filepath){
			$objWriter->save($filepath);
		}else{
			// 输出
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
			header('Cache-Control: max-age=0');
			
			$objWriter->save('php://output');
		}
	}
	
	
	/**
	 * 读取excel模板的标识
	 * 
	 * 根据既定的规则来读取excel模板的标识，用来验证导入的文件是否和系统中的模板一致
	 *
	 * 读取模式一：table模式-第一行是标题，其他的行是值
	 *
	 * @param string $filePath：文件路径
	 * @param int    $row：开始读取的行
	 * @param string $column：开始读取的列
	 * @param int    $sheetNum:默认读取的sheet索引，
	 * @return array
	 */
	public function readVerifyMark( $filePath , $row = 2, $column ='A' , $sheetNum = 0){
		
		if(!file_exists($filePath)){
			$this -> error = '文件路径错误';
			return false;
		}
	
		header('Content-Type:text/html; charset=utf-8');
	
		//获取excel文件
		$PHPExcel 		= $this -> getExcel($filePath);
	
		//如果获取到了文件
		if( $PHPExcel ){
			//读取excel文件中的工作表*/
			$currentSheet 	= $PHPExcel -> getSheet( $sheetNum );
			
			$val = $currentSheet-> getCell($column . $row )->getValue();
			
			
		}
	
		return $val;
	}

	/**
	 * 读取excel文件模式一
	 *
	 * 读取模式一：table模式-第一行是标题，其他的行是值
	 *
	 * @param int    $beginRow：开始读取的行
	 * @param string $beginColumn：开始读取的列
	 * @param string $filePath：文件路径
	 * @param int    $sheetNum:默认读取的sheet索引，
	 * @param array    $strArray:标题需要替换的字符，
	 * @param boolen $multipleSheets:读取的时候是否读取多个$multipleSheets
	 * @return array
	 */
	public function readMode1( $beginRow = 2, $beginColumn ='A' , $filePath , $sheetNum = 0, $strArray, $multipleSheets = false , $date_column_num ){

		if(!file_exists($filePath)){
			$this -> error = '文件路径错误';
			return false;
		}
	
	
		header('Content-Type:text/html; charset=utf-8');
	
		//获取excel文件
		$PHPExcel 		= $this -> getExcel($filePath);
	
		//如果获取到了文件
		if( $PHPExcel ){
			//读取excel文件中的工作表*/
			$currentSheet 	= $PHPExcel -> getSheet( $sheetNum );
			//取得最大的列号
			$allColumn 		= $currentSheet->getHighestColumn();
			//取得一共有多少行
			$allRow 		= $currentSheet->getHighestRow();
			//dump( $currentSheet );
	
			//由于如果列的数量过多。会是AA之类的，在进行字符串比较的时候，php会比较首字母无法比较，这里需要将列的字符串转换成数字进行比较
			$allColumnNum 	= PHPExcel_Cell:: columnIndexFromString( $allColumn );
			$beginColumnNum	= PHPExcel_Cell:: columnIndexFromString( $beginColumn ) - 1;
			//开始读取excel文件
			//循环行
			for($currentRow = $beginRow;$currentRow <= $allRow;$currentRow++){
	
				unset( $temp );
				//循环列
				for($currentColumnNum = $beginColumnNum ;$currentColumnNum< $allColumnNum ; $currentColumnNum++){
					
					//$val = getCellValue($PHPExcel , $currentColumn, $currentRow);
					//此次将列的数字转换成字符串
					$currentColumnstr = PHPExcel_Cell::stringFromColumnIndex($currentColumnNum );
					$val = $currentSheet-> getCell($currentColumnstr . $currentRow )->getValue();
					//$val = $currentSheet->getCellByColumnAndRow(ord($currentColumn) - 65,$currentRow)->getValue();/**ord()将字符转为十进制数*/
					$val = preg_replace('/\r|\n/', '', $val); //去掉换行
					
					
					//获取标题列表
					if($currentRow ==  $beginRow ){
						$title[] = my_trim( $val, $strArray);
					}else{
						// TODO 如果该格式为日期需要转换 ,暂时先写死
						if($date_column_num && $currentColumnNum == $date_column_num ){
							//$val = $this->excelTime($val); //gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($val));//有2038年溢出问题
							$val = gmdate("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($val));//有2038年溢出问题); //gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($val));//有2038年溢出问题
						}
						$temp[] = $val;
					}
				}
	
	
				if($temp){
					$value[] = $temp;
				}
			}
	
			$data['title'] = $title;
			$data['value'] = $value;
		}
		
		return $data;
	}
	
	
	
	/**
	 * add By Richer 于21060603
	 * 写入excel文件模式一：table模式-第一行是标题，其他的行是值
	 * 
	 * @param int    $beginRow：开始写入的行数，一般默认是从第二行写入
	 * @param string $beginColumn：开始写入的列,一般是从第三列开始写，前两列为隐藏列
	 * @param string $filePath：文件路径
	 * @param int    $sheetNum:默认读取的sheet索引，一般为0，即第一个sheet
	 * @param array  $varlue  需要写入的原始数据，该数据不需要进行特殊的处理，只要二维数组即可，格式：
	 * 			array(40) {
	 * 				[0] => array(53) {
					    ["id"] => string(2) "46"
					    ["patenttype"] => NULL
					    ["applyno"] => string(7) "fmzl023"
					    ["applydate"] => string(8) "20150925"
					    ["authorizedate"] => string(8) "20160107"
					    ["announceno"] => string(9) "US2016023"
					  }
					  [1] 
					  ...
					  ...
	 * @param array  $config  写入的配置，格式必须要按照如如下的格式：
	 * 	array(17) {
			  [0] => array(4) {
			    ["fieldname"] => string(2) "No"
			    ["columnTitle"] => string(6) "序号"
			    ["displayOnPage"] => string(1) "1"
			    ["columnWidths"] => string(1) "5"
			  }
			  [1] => array(4) {
			    ["fieldname"] => string(9) "applicant"
			    ["columnTitle"] => string(9) "申请人"
			    ["displayOnPage"] => string(1) "1"
			    ["columnWidths"] => string(2) "25"
			  }
			  ...
			  ...
	 * @param string $excelName:文件的名称
	 * @param string $excelTitle:文件标题
	 * @param array  $strArray:标题需要替换的字符，
	 * @return array
	 */
	public function writeMode1( $beginRow = 2, $beginColumn ='A' , $filePath , $sheetNum = 0, $value, $config,  $excelName,  $excelTitle, $strArray ){
		try{
			$this->_import();
			if( !$filePath ) {
				if( $beginRow < 3 ){
					$beginRow = 3;
				}
			}

			//获取开始写入的列数
			$beginColumnNo = PHPExcel_Cell::columnIndexFromString( $beginColumn ) - 1;
		
			//通过配置和数据将数组转换成可以写入excel中的格式的	
			foreach( $config as $key_ec => $vo_ec ){
				//$cellCode = $this -> stringFromColumnIndex( $key_ec+ $beginColumnNo);
				$cellCode = PHPExcel_Cell::stringFromColumnIndex( $key_ec+ $beginColumnNo );
				$column['cellCode'] 	= $cellCode;
				$column['cellValue'] 	= !empty( $vo_ec['columnTitle']) ?  $vo_ec['columnTitle'] :  $vo_ec['caption'];
				$column['cellField'] 	= $vo_ec['fieldname'];
				$column['cellWidth'] 	= $vo_ec['width'];
				$columns[] = $column;
			}
			foreach ($value as $key => $vo_p){
				unset($temp);
				foreach ( $columns as $vo_c ){
					foreach ( $vo_p as $key_p1 => $vo_p1){
						if( $vo_c['cellField'] == $key_p1 ){
							$temp[$vo_c['cellCode'] . ( $key + $beginRow ) ] = $vo_p1;
						}
					}
				}
				$newValues[] = $temp; 
			}
			
	
			//add By Richer于20160722 如果没有路径生成一个新的exce
			if( $filePath ) {
				//此处用该方法获取excel对象的实例，用上面的方法会让原来模版中的样式丢失
				$objPHPexcel = $this -> getInstance( $filePath );
				//修正Excel对象，对富文本（一个单元格中有多种样式混杂）的单元格处理
				$objPHPexcel= $this -> correctRichText( $objPHPexcel );
				//读取excel文件中的工作表*
				$workSheet 	= $objPHPexcel -> getSheet( $sheetNum );
			}else{
				
				$style1 = array (
						'borders' => array (
								'outline' => array (
										'style' => PHPExcel_Style_Border::BORDER_THIN,
										'color' => array (
												'argb' => '000000'
										)
								)
						),
						'font' => array (
								'size' => 13,
								'bold' => true,
								'color' => array (
										'argb' => '000000'
								)
						),
						'fill' => array (
								'type' => PHPExcel_Style_Fill::FILL_SOLID,
								'rotation' => 90,
								'startcolor' => array (
										'argb' => 'FFCCCCFF'
								),
								'endcolor' => array (
										'argb' => 'FFCCCCFF'
								)
						)
				);
				$style2 = array (
						'borders' => array (
								'outline' => array (
										'style' => PHPExcel_Style_Border::BORDER_THIN,
										'color' => array (
												'argb' => '000000'
										)
								)
						),
						'font' => array (
								'size' => 12,
								'bold' => true,
								'color' => array (
										'argb' => '000000'
								)
						),
						'fill' => array (
								'type' => PHPExcel_Style_Fill::FILL_SOLID,
								'rotation' => 90,
								'startcolor' => array (
										'argb' => 'FFFFFF99'
								),
								'endcolor' => array (
										'argb' => 'FFFFFF99'
								)
						)
				);
				
				
				$objPHPexcel = new PHPExcel ();
				$objPHPexcel->getProperties ()->setCreator ( "Maarten Balliauw" );
				$objPHPexcel->getProperties ()->setLastModifiedBy ( "Maarten Balliauw" );
				$objPHPexcel->getProperties ()->setTitle ( "Office 2003 XLS Test Document" );
				$objPHPexcel->getProperties ()->setSubject ( "Office 2003 XLS Test Document" );
				$objPHPexcel->getProperties ()->setDescription ( "Test document for Office 2003 XLS, generated by using PHP classes." );
				$objPHPexcel->getProperties ()->setKeywords ( "office 2003 openxml php" );
				$objPHPexcel->getProperties ()->setCategory ( "Test result file" );
				
				$objPHPexcel->setActiveSheetIndex ( 0 );
				$objPHPexcel->getDefaultStyle ()->getFont ()->setName ( '宋体' );
				$objPHPexcel->getDefaultStyle ()->getFont ()->setSize ( 10 );
				//修正Excel对象，对富文本（一个单元格中有多种样式混杂）的单元格处理
				$objPHPexcel= $this -> correctRichText( $objPHPexcel );
				//读取excel文件中的工作表*
				$workSheet 	= $objPHPexcel -> getSheet( $sheetNum );
				
				//获取当前最大的列
				$cellCode = PHPExcel_Cell::stringFromColumnIndex( count( $columns ) -1 );
				
				//在一行写入标题，并进行样式的调整
				// 设置sheet名称
				$workSheet 	-> setTitle ( $excelTitle );
				// 设置默认行高
				$workSheet -> getDefaultRowDimension ()->setRowHeight ( 25 );
				// 设置单元格固定
				$workSheet	-> freezePaneByColumnAndRow ( 0, 3 );
				// 合并单元格
				$workSheet -> mergeCells ( 'A1:'.$cellCode.'1' );
				//写入标题
				$workSheet -> setCellValue('A1', $excelTitle );
				//设置自动换行
				$workSheet -> getStyle('A1')->getAlignment()->setWrapText(true);
				// 设置字体大小
				$workSheet->getStyle ( 'A1:'.$cellCode.'1'  )->getFont ()->setSize ( 18 );
				// 设置字体加粗
				$workSheet->getStyle ( 'A1:'.$cellCode.'1'  )->getFont ()->setBold ( true );
				// 设置水平居中
				//$workSheet->getStyle ( 'A1:'.$cellCode.'1')->getAlignment ()->setHorizontal ( PHPExcel_Style_Alignment::HORIZONTAL_CENTER );
				// 垂直居中
				$workSheet 	-> getStyle ( 'A1:'.$cellCode.'1' )->getAlignment ()->setVertical ( PHPExcel_Style_Alignment::VERTICAL_CENTER );
				// 设置行高
				$workSheet	-> getRowDimension ( 1 )->setRowHeight ( 30 );
				// 设置行高
				$workSheet	-> getRowDimension ( 2 )->setRowHeight ( 30 );
				// 垂直居中
				$workSheet 	-> getStyle ( 'A2:'.$cellCode.'2' )->getAlignment ()->setVertical ( PHPExcel_Style_Alignment::VERTICAL_CENTER );
				//需要在第二行写入标题
				foreach ($columns as $key_c => $vo_c ){
					$workSheet ->getColumnDimension ( $vo_c['cellCode'] )->setWidth ( $vo_c['cellWidth'] );
					$this->setCellStyle ( $objPHPexcel, $key_c, 2, $style2 );
					$workSheet -> setCellValueExplicit( $vo_c['cellCode'] . 2, $vo_c['cellValue'] ,PHPExcel_Cell_DataType::TYPE_STRING);
				}
			}
	
			//循环数据数组
			foreach ($newValues as $key => $vo ){
				foreach ($vo as $key_v => $vo_v ){
					$vo_v = my_trim( $vo_v, $strArray);
					$workSheet -> setCellValueExplicit($key_v,$vo_v,PHPExcel_Cell_DataType::TYPE_STRING);
				}
			}
			
			
			// 输出
			if( !$excelName ){
				$excelName =  date('YmdHis');
			}
			
			// add By Richer 于20161026 增加对IE浏览器的判断，解决文件名乱码的问题
			//ob_end_clean();//清除缓冲区,避免乱码
			//判断浏览器类型，如果是ie浏览器
			load("util");
			if( getBrowser() == 'ie'){
				$excelName = str_replace('+','%20',urlencode($excelName));
			}
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$excelName.'.xls"');
			header('Cache-Control: max-age=0');
				
			//直接通过浏览器下载
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPexcel, 'Excel5');
			$objWriter->save('php://output');
			
			//return $objPHPexcel;
	
		}catch(Exception $e){
			return null;//$e->getMessage();
		}
	}
	
	
	public function stringFromColumnIndex($pColumnIndex = 0){
		//  Using a lookup cache adds a slight memory overhead, but boosts speed
		//  caching using a static within the method is faster than a class static,
		//      though it's additional memory overhead
		static $_indexCache = array();
	
		if (!isset($_indexCache[$pColumnIndex])) {
			// Determine column string
			if ($pColumnIndex < 26) {
				$_indexCache[$pColumnIndex] = chr(65 + $pColumnIndex);
			} elseif ($pColumnIndex < 702) {
				$_indexCache[$pColumnIndex] = chr(64 + ($pColumnIndex / 26)) .
				chr(65 + $pColumnIndex % 26);
			} else {
				$_indexCache[$pColumnIndex] = chr(64 + (($pColumnIndex - 26) / 676)) .
				chr(65 + ((($pColumnIndex - 26) % 676) / 26)) .
				chr(65 + $pColumnIndex % 26);
			}
		}
		return $_indexCache[$pColumnIndex];
	}
	
	

	/**
	 * 设置单元格值
	 */
	public function setCellValue($objPHPExcel, $col, $row, $val) {
		$objPHPExcel->getActiveSheet ()->getCellByColumnAndRow ( $col, $row )->setValue ( $val );
	
		$cell_index = PHPExcel_Cell::stringFromColumnIndex ( $col ) . $row;
		$objPHPExcel->getActiveSheet ()->getStyle ( $cell_index )->getAlignment ()->setHorizontal ( PHPExcel_Style_Alignment::HORIZONTAL_LEFT );
	}
	
	/**
	 * 设置单元格值及颜色
	 */
	public function setCellValueAndColor($objPHPExcel, $col, $row, $val) {
		$cell_index = PHPExcel_Cell::stringFromColumnIndex ( $col ) . $row;
		$objPHPExcel->getActiveSheet ()->setCellValue ( $cell_index, $val )->getStyle ( $cell_index )->getFont ()->getColor ()->setARGB ( PHPExcel_Style_Color::COLOR_RED );
	}
	
	/**
	 * 设置单元格值及颜色
	 */
	public function setCellValueAndColor1($objPHPExcel, $col, $row, $val) {
		$cell_index = PHPExcel_Cell::stringFromColumnIndex ( $col ) . $row;
		$objPHPExcel->getActiveSheet ()->setCellValue ( $cell_index, $val )->getStyle ( $cell_index )->getFont ()->getColor ()->setARGB ( PHPExcel_Style_Color::COLOR_BLUE );
	}
	
	/**
	 * 设置单元格样式
	 */
	public function setCellStyle($objPHPExcel, $col, $row, $style) {
		$cell_index = PHPExcel_Cell::stringFromColumnIndex ( $col ) . $row;
		$objPHPExcel->getActiveSheet ()->getStyle ( $cell_index )->applyFromArray ( $style )->getAlignment ()->setHorizontal ( PHPExcel_Style_Alignment::HORIZONTAL_LEFT );
	}
	
	/**
	 * 设置行高
	 */
	public function setRowHeight($objPHPExcel, $row, $height) {
		$objPHPExcel->getActiveSheet ()->getRowDimension ( $row )->setRowHeight ( $height );
	}
	
	/**
	 * 设置列宽
	 */
	public function setColWidth($objPHPExcel, $col, $width) {
		$colWord = PHPExcel_Cell::stringFromColumnIndex ( $col );
		$objPHPExcel->getActiveSheet ()->getColumnDimension ( $colWord )->setWidth ( $width );
	}
	
	/**
	 * 合并单元格
	 */
	public function mergeCells($objPHPExcel, $c1, $r1, $c2, $r2) {
		$cell1 = PHPExcel_Cell::stringFromColumnIndex ( $c1 ) . $r1;
		$cell2 = PHPExcel_Cell::stringFromColumnIndex ( $c2 ) . $r2;
		$objPHPExcel->getActiveSheet ()->mergeCells ( $cell1 . ':' . $cell2 );
	}
	
}
?>