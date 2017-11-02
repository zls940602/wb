<?php
namespace app\home\model;

use think\Model;
use think\Request;
Class Art extends Model{
    //托管师model
        public function getArt(){
            $art = Art::select();
            return $art;
        }
}