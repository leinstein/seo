<?php 
/**
 * 挂件：领军空间人才简介
 * 参数：
 *
 *调用：{:w('LeadingTalentIntro')}
 * @copyright   Copyright 2010-2015 @DEJAX @JnW (www.dejax.cn)
 * @package     Widget
 * @version     20150923
 * @link        http://www.dejax.cn
 */
class LeadingTalentIntroWidget extends Widget{
    /**
     * 渲染方法
     *@param $data 挂件传入的数组
     *@return $content 传出挂件模板的
     */
    public function render($data = null){
        $model_baseinfo  = D('Biz/LeadingTalentBaseInfo');
        $model_index = D('Biz/LeadingTalentIndexInfo');
        $model_enterprise = D('Biz/LeadingTalentEnterpriseInfo');
        $model_project = D('Biz/LeadingTalentProjectInfo');
        $model_property = D('Biz/LeadingTalentPropertyInfo');
        $pieid = $_GET['id'];

        if(!$pieid){
            return  '本条信息不存在';
        }

        $map_baseinfo['pieid'] = $pieid;
        $map_index['objectid'] = $pieid;

        $data['model_property'] = $model_property ->selectOne($map_baseinfo);
        $data['model_project']  = $model_project ->selectOne($map_baseinfo);
        $data['data_enterprise'] = $model_enterprise -> selectOne($map_baseinfo);
        $data['data_index'] = $model_index -> selectOne($map_index);
        $data['data_baseinfo'] = $model_baseinfo -> selectOne($map_baseinfo);

        $content =  $this->renderFile('LeadingTalentIntro',$data);

        return $content;
    }
}


















 ?>