<?php
namespace app\home\controller;

use think\Controller;

class S extends Controller
{   //首次登陆选择的页面
    //查询离的最近的。
    //要将用户输入的地址通过api备注为经纬度。
    public function one(){
        $art = db('art')->where('State','NEQ',1)->order(['Assess'=>'desc'])->select();//查询出当前最高分和托管师是否空闲
        var_dump($art);die();
        $this->assign('data',$art['0']);
        return $this->fetch();
    }
}