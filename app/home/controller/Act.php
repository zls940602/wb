<?php
namespace app\home\controller;

use think\Controller;
use app\common\model\User;
class Act extends Controller{  
    //激活页面
    public function index(){
        //判断是否是post提交数据：request()->isPost()
        if(request()->isPost()){
            $res = (new User())->act(input('post.'));
        if ($res['valid']) {
            //成功
            $this->success($res['msg'],'S/one');
        }else{
            $this->error($res['msg']);exit();
        }
    }
        
        return $this->fetch('login');
    }

    //首页内容
    public function hp(){
        $id = session('user_id');
        $A_id = db('user')->where('id',$id)->value('A_id');
        $data = db('progress')->where('A_id',$A_id)->select();
        $this->assign('data',$data[0]);        
        return $this->fetch();
    }

    //个人中心页面
    public function pct(){
        $id = session('user_id');
        //var_dump($id);die();
        $data = db('user')->where('id',$id)->select();
        //var_dump($data);die();
        $this->assign('data',$data[0]);
        return $this->fetch();
    }

    //修改信息页面
    public function modif(){
        $id = session('user_id');
        //判断是不是post方式提交数据
        if(request()->isPost()) {
                //将post提交得到的数据更新到数据库
                $data = input('post.');
                $data['time'] = time();
                //var_dump($data['time']);die();
                $xin = db('user')->where('id',$id)->update(array('Name'=>$data['Name'],'Tel'=>$data['Tel'],'Adder'=>$data['Adder']));
                //var_dump($xin);die();
                        if($xin){
                            $this->success('修改成功', 'pct');
                        }else{
                            $this->error('修改失败', 'modif');
                        }
            }else{
                        $data = db('user')->where('id',$id)->select();
                        //var_dump($data);die();
                        $this->assign('data',$data[0]);
                        return $this->fetch();
            }

    }

    //评价页面
    public function appraise(){

        return $this->fetch();
    }

    //托管师页面
    public function art(){
        $id = session('user_id');
        //查询对应的托管师信息输出给模板
        $A_id = db('user')->where('id',$id)->value('A_id');
        $data = db('art')->where('id',$A_id)->select();
        //print_r($art);die();
        $this->assign('data',$data[0]);
        return $this->fetch();
    }

    //更换托管师页面
    public function replacement(){
        $id = session('user_id');
        if(request()->isPost()){
            $data = input('post.');
            $data['A_id'] = $A_id = db('user')->where('id',$id)->value('A_id');
            $data['U_id'] = $U_id = $id;
            //print_r($data);die();
            $info = db('change')->insert($data);
            //print_r($info);die();
            if ($info) {
                $this->success('提交成功', 'hp');
            }else{
                $this->error('提交失败', 'replacement');
            }
        }
        return $this->fetch();
    }
}
