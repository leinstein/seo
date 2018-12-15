<?php

// +----------------------------------------------------------------------
// | DEJAX [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2009 http://dejax.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// $Id$

/**
 +------------------------------------------------------------------------------
 * HTML标签库解析类
 +------------------------------------------------------------------------------
 * @category   Think
 * @package  Think
 * @subpackage  Template
 * @version   $Id$
 +------------------------------------------------------------------------------
 */
 
import('TagLib');
//类定义开始

class TagLibLps extends TagLib
{
	// 标签定义
    protected $tags   =  array(
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        'linkButton'  => array('attr'=>'id,name,class,href,target,caption,style,onclick','close'=>1),
        'button'      => array('attr'=>'id,name,class,value,type,visible,disable,onclick','close'=>1),
        'dateselect'  => array('attr'=>'id,name,postformat,show,value,inputtype,startyear,endyear,styleclass,style,theme','close'=>0),
        'checkbox'    => array('attr'=>'checkboxs,name,checkbox,separator','close'=>0),
        'radio'       => array('attr'=>'radios,name,checked,separator','close'=>0),
        'imgButton'   => array('attr'=>'id,name,class,width,caption,style,onclick,href,target,iconclass','close'=>1)
        );
    /**
     +----------------------------------------------------------
     * dateselect标签解析
     * 格式： <html:dateselect id="id" startyear="1930" />
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _dateselect($attr)
    {
        $tag        	= $this->parseXmlAttr($attr,'dateselect');
        $id         	= $tag['id'];
        $name       	= $tag['name'];
        $postformat    	= $tag['postformat'];//保存日期格式。如1985-11-17
        $show     		= $tag['show'];//选项个数。如只有年份的选项，只有年份月份的选项和有年，月，日的选择
        $values     	= $tag['value'];//初始值
		$inputtype 		= $tag['inputtype'];//年份输入风格，包括default-选择域和Textbox-输入域
		$startyear_ 	= $tag['startyear'];//开始年份设置，设置为与当前年份的差值，如-100表示前100年，5表示后5年；
		$endyear_ 		= $tag['endyear'];//结束年份设置，同上；
		$styleclass 	= $tag['styleclass'];//样式class
		$style 			= $tag['style'];//样式
		$theme 			= $tag['theme'];//主题：目前支持birthday和orgbuildday（企业注册时间）  如：birthday	= ( startyear:-100, endyear:-5, inputtype:default)
		
		//如果设置了生日主题，部分属性按主题配置
		if($theme == 'birthday'){
			$inputtype = 'default';//年份下拉选择
			$show = 'year,month,day';//显示年，月，日
			$startyear_ = '-100';//年份开始选择日期为前100年
			$endyear_ = '-5';//年份截止选择日期为前5年
		}
		
		//如果设置了企业注册时间主题，部分属性按主题配置
		if($theme == 'orgbuildday'){
			$inputtype = 'textbox';//年份为输入域
			$show = 'year,month';//显示年，月
		}

		//如果name为空，则默认和id一致
		if(empty($name)){
			$name = $id;	
		}
		
		//year表示显示年份，monty显示月份选项，day表示显示日选项。如果为空，默认都显示
		if(empty($show)){
			$show = 'year,month,day';
		}
		
		//如果开始年份没有设置，默认为前100年
		if(empty($startyear_)){
			$startyear_ = '-100';
		}
		
		$begyear = date("Y",strtotime($startyear_." year",strtotime(date("Y"))));
		//如果异常，也默认为当年
		if(empty($begyear)){
			$begyear = date("Y");
		}
		
		//如果结束年份没有设置，默认为前0年
		if(empty($endyear_)){
			$endyear_ = '+0';
		}
		$endyear = date("Y",strtotime($endyear_." year",strtotime(date("Y"))));
		//如果异常，也默认为当年
		if(empty($endyear)){
			$endyear = date("Y");
		}
		
		//处理值的显示问题
		$setValueStr = '<?php $date_values = $'.$values.'; ';
		$setValueStr .= ' $date_year = date("Y",strtotime($date_values)); '; //年
		$setValueStr .= ' $date_month = date("n",strtotime($date_values)); '; //月
		$setValueStr .= ' $date_day = date("j",strtotime($date_values)); ?>'; //日
		
		//如果要显示年份下拉选项。
        if(strstr($show,'year')) {
			
			//如果是企业性质的生日，则人工输入年份
			if($inputtype  == 'Textbox'){
				$parseStrYear = '<td> <input id="'.$id.'_year" class="'.$styleclass.'"  style="'.$style.'" type="text" size="1" onchange="changeyear_ymd(\''.$id.'\');"  value="'.$year.'" /> 年 ';
			}else{
				$parseStrYear .= '<td> <select id="'.$id.'_year"  class="'.$styleclass.'"  style="'.$style.'" onchange="changeyear_ymd(\''.$id.'\');" >';
				//$parseStr   .= '<option  value=""></option>';
				$parseStrYear   .= '<?php  for($i='.$begyear.';$i<='.$endyear.';$i++) { ?>';
				
				$parseStrYear   .= '<?php if(!empty($date_year)){  ?>';
					$parseStrYear   .= '<?php if($date_year == $i) { ?>';
					$parseStrYear   .= '<option selected="selected" value="<?php echo $i ?>"><?php echo $i ?></option>';
					$parseStrYear   .= '<?php }else { ?><option value="<?php echo $i ?>"><?php echo $i ?></option>';
					$parseStrYear   .= '<?php } ?>';
				$parseStrYear   .= '<?php }else{ ?>';
					$parseStrYear   .= '<option value="<?php echo $i ?>"><?php echo $i ?></option>';
				$parseStrYear   .= '<?php } ?>';
			
				$parseStrYear   .= '<?php } ?>';
				$parseStrYear   .= '</select> </td> <td>年</td> ';
 			}
         }

		//如果要显示月份下拉选项。
        if(strstr($show,'month')) {
			
            $parseStrMonth   = '<td> <select id="'.$id.'_month"  class="'.$styleclass.'"  style="'.$style.'" onchange="changemonth_ymd(\''.$id.'\');" >';
			//$parseStr   .= '<option  value=""></option>';
            $parseStrMonth   .= '<?php  for($i= 1;$i<= 12;$i++) { ?>';
           		$parseStrMonth   .= '<?php if(!empty($date_month)){  ?>';
					$parseStrMonth   .= '<?php if($date_month == $i) { ?>';
					$parseStrMonth   .= '<option selected="selected" value="<?php echo $i ?>"><?php echo $i ?></option>';
					$parseStrMonth   .= '<?php }else { ?><option value="<?php echo $i ?>"><?php echo $i ?></option>';
					$parseStrMonth   .= '<?php } ?>';
				$parseStrMonth   .= '<?php }else{ ?>';
					$parseStrMonth   .= '<option value="<?php echo $i ?>"><?php echo $i ?></option>';
				$parseStrMonth   .= '<?php } ?>';	
            
            $parseStrMonth   .= '<?php } ?>';
 			$parseStrMonth   .= '</select> </td> <td>月</td> ';
         }

		//如果要显示天下拉选项。
        if(strstr($show,'day')) {
			
            $parseStrDay   = '<td> <select id="'.$id.'_day"  class="'.$styleclass.'"  style="'.$style.'" onchange="changeday_ymd(\''.$id.'\')" >';
			$parseStrDay   .= '<?php  for($i= 1;$i<= 31;$i++) { ?>';
            	$parseStrDay   .= '<?php if(!empty($date_day)){  ?>';
					$parseStrDay   .= '<?php if($date_day == $i) { ?>';
					$parseStrDay   .= '<option selected="selected" value="<?php echo $i ?>"><?php echo $i ?></option>';
					$parseStrDay   .= '<?php }else { ?><option value="<?php echo $i ?>"><?php echo $i ?></option>';
					$parseStrDay   .= '<?php } ?>';
				$parseStrDay   .= '<?php }else{ ?>';
					$parseStrDay   .= '<option value="<?php echo $i ?>"><?php echo $i ?></option>';
				$parseStrDay   .= '<?php } ?>';
            
            $parseStrDay   .= '<?php } ?>';
 			$parseStrDay   .= '</select> </td><td>日<span id="date_result" ></span></td>';
         }
		
		$parseStr = $setValueStr.' <table> <tr> '.$parseStrYear.$parseStrMonth.$parseStrDay.' </tr> </table>';
		
		 //设置隐藏域保存标签值
		$parseStr   .= '<input id="'.$id.'_value" name="'.$name.'" type="hidden" postformat="'.$postformat.'" />';
		//处理标签值格式
		$parseStr   .= '<script>setDateToValue("'.$id.'");</script>';

        return $parseStr;
    }
	
	/**
     +----------------------------------------------------------
     * checkbox标签解析, checked可以使用变量，格式为 男,女,
     * 格式： <html:checkbox checkboxs="" checked="" />
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _checkbox($attr)
    {
        $tag        = $this->parseXmlAttr($attr,'checkbox');
        $name       = $tag['name'];
        $checkboxes = $tag['checkboxs']; 
        $checked    = $tag['checked'];
        $separator  = $tag['separator'];
		//特殊处理。如果separator='br'表示要换行(临时实现方式)
		if( $separator == 'br')
			$separator = '<br/>';
			
       	$parseStr	= ''; 
		
		if( !empty($checkboxes) ) {
		
			if( !empty($checked) ) {
				$parseStr .= '<?php $checked = split("," , $'.$checked.'); ?>';
			}else{
				$parseStr .= '<?php $checked = array(); ?>';
			}
			
			$parseStr .= '<?php foreach ( $'.$checkboxes.' as $key=>$val ) { ?>';
			$parseStr .= '<?php 	if ( $checked == $key  || in_array($key, $checked) ) { ?>';
			$parseStr .= '<input type="checkbox" checked="checked" name="'.$name.'[]" value="<?php echo $key?>"><?php echo $val?>'.$separator;
			$parseStr .= '<?php 	}else{ ?>';
			$parseStr .= '<input type="checkbox" name="'.$name.'[]" value="<?php echo $key?>"><?php echo $val?>'.$separator;
			$parseStr .= '<?php 	} ?>';
			$parseStr .= '<?php } ?>';
		}
		
        return $parseStr;
    }

    /**
     +----------------------------------------------------------
     * radio标签解析
     * 格式： <html:radio radios="name" checked="value" />
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _radio($attr)
    {
        $tag        = $this->parseXmlAttr($attr,'radio');
        $name       = $tag['name'];
        $radios     = $tag['radios'];
        $checked    = $tag['checked'];
        $separator  = $tag['separator'];
		
		//特殊处理。如果separator='br'表示要换行(临时实现方式)
		if( $separator == 'br')
			$separator = '<br/>';
        $parseStr   = '';
		if( !empty($checked) ) {
			$parseStr .= '<?php $checked = $'.$checked.'; ?>';
		}	
		$parseStr .= '<?php foreach ( $'.$radios.' as $key=>$val ) { ?>';
		$parseStr .= '<?php 	if ( $checked == $key ) { ?>';
		$parseStr .= '<input type="radio" checked="checked" name="'.$name.'" value="<?php echo $key?>"><?php echo $val?>'.$separator;
		$parseStr .= '<?php 	}else{ ?>';
		$parseStr .= '<input type="radio" name="'.$name.'" value="<?php echo $key?>"><?php echo $val?>'.$separator;
		$parseStr .= '<?php 	} ?>';
		$parseStr .= '<?php } ?>';
		
		//为了防止没有选中radio信息时字段不能提交问题，在标签前新增一个隐藏域用于提交空值。如果radio选中后再提交时，会提交选中的值。
		if(empty($checked)){
			$parseStr = '<input type="hidden" name="'.$name.'" value="">'.$parseStr;
		}
		
        return $parseStr;
    }
 
    /**
     +----------------------------------------------------------
     * imgButton标签解析
     * 格式：<lps:imgButton id="btn01_id" name="btn01_name" style="display:" class="btn02" width="127" caption="点击这里开始体验" onclick="alert('test!')" iconclass="tocot02"/>
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _imgButton($attr)
    {
        $tag        = $this->parseXmlAttr($attr,'imgButton');
        $id       	= $tag['id'];
        $name       = $tag['name'];
        $class    	= $tag['class'];
        $width    	= $tag['width'];
        $caption   	= $tag['caption'];
        $style   	= $tag['style'];
		if( !empty( $tag['href'] ) )
        	$href    	= $tag['href'];
		else
			$href    	= "javascript:void(0);";
        $target    	= $tag['target'];
        $iconclass  = $tag['iconclass'];
        $onclick   	= $tag['onclick'];
		
		$parseStr = '<div ';
		if(!empty($id)){
			$parseStr .= ' id="'.$id.'"';
		}	
		if(!empty($name)){
			$parseStr .= ' name="'.$name.'"';
		}		
		if(empty($class)){
			$class = 'btn01';//默认样式为btn01
		}
		$parseStr .= ' class="'.$class.'"';
		$parseStr .= '> <a ';
		if(!empty($href)){
			$parseStr .= ' href="'.$href.'"';
			if(empty($target)){
				$target .= '_self';//默认目标窗口为新窗口
			}	
			$parseStr .= ' target="'.$target.'"';
		}	
		if(!empty($onclick)){
			$parseStr .= ' onclick="'.$onclick.'"';
		}	
		if(empty($width)){
			$width = '55';//默认宽度为55px
		}
		$parseStr .= ' ><span style="width:'.$width.';" ';
		if(!empty($style)){
			$parseStr .= ' style="'.$style.'"';
		}
		$parseStr .= '> ';	
		if(!empty($iconclass)){
			$parseStr .= ' <div class="'.$iconclass.' mt5 ml5 mb5"></div>';//iconclass目前支持以下属性：tocot02-购物车图标
		}
		$parseStr .= $caption.'</span></a></div>';							
		return $parseStr;
    }
 
    /**
     +----------------------------------------------------------
     * _linkButton标签解析
     * 格式：<lps:linkButton id="id001" name="name001" style="display:" class="flatbtn01" caption="增加" href="#" target="_self" onclick="alert('test!')"/>
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _linkButton($attr)
    {
        $tag        = $this->parseXmlAttr($attr,'linkButton');
        $id       	= $tag['id'];
        $name       = $tag['name'];
        $class    	= $tag['class'];
        $style   	= $tag['style'];
        $onclick   	= $tag['onclick'];
        $href    	= $tag['href'];
        $target    	= $tag['target'];
        $caption   	= $tag['caption'];
		
		$parseStr = '<span ';
		if(!empty($id)){
			$parseStr .= ' id="'.$id.'"';
		}	
		if(!empty($name)){
			$parseStr .= ' name="'.$name.'"';
		}
		if(!empty($class)){
			$parseStr .= ' class="'.$class.'"';
		}	
		if(!empty($style)){
			$parseStr .= ' style="'.$style.'"';
		}	
		if(!empty($onclick)){
			$parseStr .= ' onclick="'.$onclick.'"';
		}	
		$parseStr .= '> <a ' ;
		if(!empty($href)){
			$parseStr .= ' href="'.$href.'"';
			if(empty($target)){
				$target = '_self';//默认目标窗口为新窗口
			}	
			$parseStr .= ' target="'.$target.'"';
		}	
		$parseStr .= ' > ' ;
		if(!empty($caption)){
			$parseStr .= $caption;
		}
		$parseStr .= ' </a> </span> ' ;
		
		return $parseStr;
    }

    /**
     +----------------------------------------------------------
     * _linkButton标签解析
     * 格式：<lps:button type="submit" id="id001" name="name001" class="button" value="提交" onclick="alert('test!')"/>
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $attr 标签属性
     +----------------------------------------------------------
     * @return string|void
     +----------------------------------------------------------
     */
    public function _button($attr)
    {
        $tag        = $this->parseXmlAttr($attr,'button');
        $id       	= $tag['id'];
        $name       = $tag['name'];
        $class    	= $tag['class'];
        $type   	= $tag['type'];
        $value    	= $tag['value'];
        $disabled   = $tag['disabled'];
        $visible   	= $tag['visible'];
        $onclick   	= $tag['onclick'];
		
		$parseStr = '<input ';
		if(!empty($id)){
			$parseStr .= ' id="'.$id.'"';
		}
		if(!empty($name)){
			$parseStr .= ' name="'.$name.'"';
		}
		if(empty($class)){
			$class = 'button';//默认按钮样式为button
		}
		$parseStr .= ' class="'.$class.'"';
		if(!empty($type)){
			$parseStr .= ' type="'.$type.'"';
		}
		if(!empty($value)){
			$parseStr .= ' value="'.$value.'"';
		}
		if(!empty($disabled)){
			$parseStr .= ' disabled="'.$disabled.'"';
		}
		if(!empty($visible)){
			$parseStr .= ' visible="'.$visible.'"';
		}
		if(!empty($onclick)){
			$parseStr .= ' onclick="'.$onclick.'"';
		}
		$parseStr .= ' /> ';
		return $parseStr;
    }

}
?>