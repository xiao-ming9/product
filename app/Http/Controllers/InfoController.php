<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Good;
use App\Type;
use App\Info;

class InfoController extends BaseController
{
    //新品推荐
    public function newGood()
    {
        $newGood = [];
        $typeName = [];
        for($i=1;$i<=10;$i++){
            $newGood[] = Good::where('type_id',$i)
                            ->orderBy('updated_at','desc')
                            ->take(6)
                            ->get();
        }
        $types = Type::all();
        foreach($types as $type){
            $typeName[] = $type->name;
        }
        return $this->returnMsg('200','ok',[
            'newgood'=>$newGood,
            'typename'=>$typeName
        ]);
    }
    
    //公告
    public function notice()
    {
        $notices = Info::where('type',0)
                    ->orderBy('updated_at','desc')
                    ->get();
        return $this->returnMsg('200','ok',$notices);
    }
    //尖端科技
    public function tech()
    {
        $tech = Info::where('type',1)
                    ->orderBy('updated_at','desc')
                    ->get();
        return $this->returnMsg('200','ok',$tech);
    }
    //网络研讨会
    public function web()
    {
        $web = Info::where('type',2)
                    ->orderBy('updated_at','desc')
                    ->get();
        return $this->returnMsg('200','ok',$web);
    }
    //食药咨询
    public function food()
    {
        $food = Info::where('type',3)
                    ->orderBy('updated_at','desc')
                    ->get();
        return $this->returnMsg('200','ok',$food);
    }
    //最新应用
    public function newApp()
    {
        $newApp = Info::where('type',4)
                    ->orderBy('updated_at','desc')
                    ->get();
        return $this->returnMsg('200','ok',$newApp);
    }
}
