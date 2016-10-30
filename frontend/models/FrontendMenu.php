<?php

namespace frontend\models;

use common\models\Menu;
use Yii;

class FrontendMenu extends Menu
{
    public static function getMenu(){
        $data = [];
        $list = FrontendMenu::find()
            ->where(['=', 'parrent_id', 0])
            ->asArray()
            ->all();
        foreach ($list as $item){
            $data[$item['id']]  = $item;
            $data[$item['id']]['child'] =  FrontendMenu::getChildMenu($item['id']);
        }
        return $data;
    }

    public static function getChildMenu($parrent_id){
        return FrontendMenu::find()
            ->where(['=', 'parrent_id', $parrent_id])
            ->asArray()
            ->all();
    }
}
