<?php
namespace app\common\model;

use think\Model;
use think\Loader;
class User extends Model{
    //设置当前模型对应的完整的数据表名称
    protected $table = 'wb_user';
    //激活
    public function act($data){
        //验证器
        $validate = Loader::validate('Yz');

        if(!$validate->check($data)){
            return ['valid'=>0,'msg'=>$validate->getError()];
        }
        //比对手机号,激活码。
        //print($data['Tel']);die();
        $info1 = db('user')->where('Tel',$data['Tel'])->find();
        if($info1 != null){
            //var_dump($info1);die();
            return ['valid'=>0,'msg'=>'该手机号已经注册'];
        }else{
            $info2 = db('code')->where('Code',$data['Code'])->find();
            if($info2 != null){
                $info3 = db('code')->where('Code',$data['Code'])->where('IsUse',1)->find();
                //var_dump($info3);die();
                if($info3 != null){
                    return ['valid'=>0,'msg'=>'激活码已经激活']; 
                }else{
                    db('code')->where('Code',$data['Code'])->update(['IsUse'=>1]);
                    $id = db('user')->insertGetId($data);
                    //var_dump($id);die();
                }
            }else{
                return ['valid'=>0,'msg'=>'激活码错误'];
            }
        }
        //是否报备。查看是否报备电话号码与激活码。如果有写入业主id，没有就算了呗。
        $creuser = db('creuser')->where(array('Tel'=>$data['Tel'],'Code'=>$data['Code']))->find();
        if($creuser != null){
            db('creuser')->where(array('Tel'=>$data['Tel'],'Code'=>$data['Code']))->update(['U_id'=>$id]);
        }
        //保存信息到session中
        session('user_id',$id);
        session('user_name',$data['Name']);
        return ['valid'=>1,'msg'=>'激活成功'];
    }
}
