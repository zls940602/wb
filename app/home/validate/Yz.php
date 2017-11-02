<?php
namespace app\home\validate;

use think\Validate;

class Yz extends Validate
{
    protected $rule = [
        'Name'  =>  'require|max:20',
        //'Tel' =>  'require|mobile',
        'Adder' =>  'require',
        'Budget' =>  'require',
        'Dp' =>  'require',
        'Code' =>  'require|alphaNum',
    ];
    protected $message = [
        'Name.require'  => '请输入用户名',
        'Name.max'  => '用户名不能超过20个字',
        'Tel.require'  => '请输入手机号码',
        'Tel.mobile'  => '电话号码出错',
        'Adder.require'  => '地址必须填写',
        'Budget.require'  => '请选择预算',
        'Dp.require'  => '请选择装修进度',
        'Code.require'  => '请填写激活码',
        'Code.alphaNum'  => '激活码是字母与数字',
    ];

}