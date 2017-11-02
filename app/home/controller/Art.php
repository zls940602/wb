<?php
namespace app\home\controller;

use think\Controller;

class Art extends Controller
{   //托管师登录页面
    public function index(){
        return $this->fetch('login');

    }
}
