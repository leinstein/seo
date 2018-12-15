<?php

/**
 * 挂件：站点详情挂件
 * 用法：{:W('ObjList', array('objname'=>'Epidenty'))}
 * 
 * @copyright   Copyright 2017-2017 上海启搜网络科技有限公司(www.qisobao.com)
 * @package     Widget
 * @version     20170519
 * @link        http://www.qisobao.com
 */
class SiteDetailWidget extends Widget{

	//渲染方法
    public function render($data){
    	
    	// 当前登录用户的信息
    	$me 	= $data['me'];
    	// 站点信息
    	$site 	= $data['data'];
    	switch ( $me['usertype'] ) {
    		case 'sub':// 子用户
    			
    			switch ( $data['operate'] ) {
    				case 'insert':
    					$data['can_insert'] 		= '1';
    					break;
    				case 'update':
    					// update By Richer 于2017年9月5日17:08:24 合作停的站点也可以修改为待审核核优化中
    					if( $site['sitestatus'] == '待审核'){
    						$data['can_update'] 	= '1';
    					}
    					break;
    				default:
    					;
    					break;
    			}
    			break;
    		case 'customer_manager':// 客服经理
    		case 'customer':// 客服
    			// 只能修改站点的ftp和后台信息，其他信息不能修改
    			$data['edit_rights'] = 'rights1';
    			$data['can_edit_ftp'] 		= '1';
    		break;
    		case 'operation_manager':// 运维经理
    		case 'operation':// 运维
    			switch ( $data['operate'] ) {
    				case 'review':
    					// update By Richer 于2017年9月5日17:08:24 合作停的站点也可以修改为待审核核优化中
    					if( $site['sitestatus'] == '待审核' || $site['sitestatus'] == '优化中'){
    						$data['can_review'] = '1';
    					}
    					
    				break;
    				case 'update':
    					// update By Richer 于2017年9月5日17:08:24 合作停的站点也可以修改为待审核核优化中
    					if( $site['sitestatus'] == '合作停'){
    						$data['can_edit_reviewstatus'] = '1';// 修改审核状态
    					}
    					// 优化中的站点也可以修改审核意见
    					if( $site['sitestatus'] == '优化中'){
    						$data['can_edit_reviewopinion'] = '1';// 修改审核意见
    					}
    					$data['can_edit_mbstatus'] 	= '1';// 修改后台状态信息
    					$data['can_update'] 		= '1';// 修改站点信息
    					break;
    				default:
    					;
    				break;
    			}
    	
    			break;
    		
    		default:
    			;
    		break;
    	}
    	
    	$data['ManageBackgroundStatusOptions']  = C('ManageBackgroundStatusOptions');

        $SiteStatusOptions = C('SiteStatusOptions');
        // 优化中的关键词审核只能审核为合作厅的状态
        switch ( $site['sitestatus'] ) {
            case '优化中':
               	// unset($SiteStatusOptions['待审核']);
                unset($SiteStatusOptions['优化中']);
                unset($SiteStatusOptions['被拒绝']);
                break;
            case '待审核':
                unset($SiteStatusOptions['待审核']);
                unset($SiteStatusOptions['合作停']);
                break;
            case '合作停':
                unset($SiteStatusOptions['合作停']);
                unset($SiteStatusOptions['被拒绝']);
                break;
            
            default:
                # code...
                break;
        }

        
    	$data['SiteStatusOptions']  = $SiteStatusOptions;
    	$skin = $data['skin'];
    	if( $skin ){
    		$content = $this->renderFile('SiteDetail_'.$skin,$data);
    	}else{
    		$content = $this->renderFile('SiteDetail',$data);
    	}
		
        return $content;  
    } 
}
?>