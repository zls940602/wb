<?php
namespace app\home\controller;

use think\Controller;

class Cop extends Controller
{   //商家登录页面
    public function index(){
        
        return $this->fetch('login');

    }
}
