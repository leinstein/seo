<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 2016/8/11
 * Time: 11:36
 */

class TagsAndFeaturesOptionWidget extends Widget{
    //渲染方法
    public function render($data){
        //产业分类
        $tagMap = array('nodelevel' => 1, "treetype" => 'tag');
        $TagModel = D('Biz/OfficialTag');
        $officialtag = $TagModel->where($tagMap)->order('orderno')->field('catename')->select();
        $data['tagOptions'] = $officialtag;

        //产业特征
        $tagMap = array('nodelevel' => 1, "treetype" => 'feature');
        $featureOptions = $TagModel->where($tagMap)->order('orderno')->field('catename')->select();
        $data['featureOptions'] = $featureOptions;

        $content = $this->renderFile('index', $data);
        return $content;
    }
}