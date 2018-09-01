<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Good;
use App\Type;
use App\SecondType;
use App\ThirdType;

class SearchController extends BaseController
{
    /**
     * 按名称搜索
     */
    public function searchByName(Request $request,$name)
    {
        if(!$name){
            return $this->returnMsg(5005,'lack param name');
        }
        $goods = Good::where('name','like','%'.$name.'%')->paginata(30);
        //获取所有二级分类
        $types = [];
        //获取所有品牌
        $brands = [];
        foreach($goods as $good){
            $name = $good->secondType->name;
            $brand = $good->brand;
            if(!(in_array($name,$type))){
                $types[] = $name;
            }
            if(!(in_array($brand,$brands))){
                $brands[] = $brand;
            }
        }
        //根据类型显示商品
        $type = $request->query('type','');
        if(!empty($type)){
            $type_id = SecondType::where('name',$type)->first()->id;
            $goods = $goods->where('secondtype_id',$type_id);
        }
        return $this->returnMsg(200,'ok',[
                'goods'=>$goods,
                'type'=>$types,
                'brand'=>$brands
        ]);
    }
    
    /**
     * 按类搜索
     */
    public function search(Request $request)
    {
        $type = $request->query('type','');             //一级分类
        $secondType = $request->query('second_type','');//二级分类
        $thirdType = $request->query('third_type','');  //三级分类
        $brand = $request->query('brand','');           //品牌
        $shape = $request->query('shape','');           //形状
        $capacity = $request->query('capacity','');     //容量
        $category = $request->query('category','');     //类别
        
        if((!empty($type))&&(!empty($secondType))){
            $type_id = Type::where('name',$type)->first()->id;
            $secondType_id = SecondType::where('name',$secondType)->first()->id;
            $goods = Good::where([
                ['type_id','=',$type_id],
                ['secondtype_id','=',$secondType_id]
            ])->paginate(30);
        }else{
            return $this->returnMsg(5005,'lack param type');
        }
        if(!empty($thirdType)){
            $thirdType_id = ThirdType::where('name',$thirdType)->first()->id;
            $goods = $goods->where('thirdtype_id',$thirdType_id);
        }
        if(!empty($brand)){
            $goods = $goods->where('brand',$brand);
        }
        if($type_id <= 2){
            if(!empty($shape)){
                $goods = $goods->where('shape',$shape);
            }
            if(!empty($capacity)){
                $goods = $goods->where('capacity',$capacity);
            }
            if(!empty($category)){
                $goods = $goods->where('category',$category);
            }
        }
        
        //返回商品品牌等信息
        if(!$goods->isEmpty()){
            $thirdTypes = [];
            $brands = [];
            foreach($goods as $good){
                $thirdType = $good->thirdType->name;
                $brand = $good->brand;
                if(!in_array($thirdType,$thirdTypes)){
                    $thirdTypes[] = $thirdType;
                }
                if(!in_array($brand,$brands)){
                    $brands[] = $brand;
                }
            }
            if($type_id <= 2){
                $shapes = [];
                $capacities = [];
                $categories = [];
                foreach($goods as $good){
                    $shape = $good->shape;
                    $capacity = $good->capacity;
                    $category = $good->category;
                    if(!in_array($shape,$shapes)){
                        $shapes[] = $shape;
                    }
                    if(!in_array($capacity,$capacities)){
                        $capacities[] = $capacity;
                    }
                    if(!in_array($category,$categories)){
                        $categories[] = $category;
                    }
                }
                return $this->returnMsg('200','ok',[
                    'type'=>$thirdTypes,
                    'brand'=>$brands,
                    'shape'=>$shapes,
                    'capacity'=>$capacities,
                    'category'=>$categories
                ]);
            }
            return $this->returnMsg('200','ok',['type'=>$thirdTypes,'brand'=>$brands]);
        }else{
            return $this->returnMsg(5005,'empty goods');
        }
    }

    /**
     * 商品详情
     */
    public function detail(Request $request)
    {
        $id = $request->query('id');
        if(!$id){
            return $this->returnMsg('5005','lack param id');
        }
        $good = Good::findOrFail($id);
        return $this->returnMsg('200','ok',$good);
    }

    /**
     * 首页商品分类
     */
    public function type()
    {
        $allTypeName = [];
        $type = Type::all();
        foreach($type as $v){
            $typeName[] = $v->name;
        }
        for($i=1;$i<=10;$i++){
            $secondType = SecondType::where('type_id',$i)->get();
            foreach($secondType as $v){
                $secondTypeName = array(
                    $typeName[$i-1] => array($v->name)
                );
                array_push($secondTypeName,$allTypeName);
                $allTypeName[$typeName[$i-1]][$v->name] = arrry(
                    $v->thirdType->name
                );
            }
        }
        return $this->returnMsg('200','ok',$allTypeName);
    }
    // public function a(){
    //     $b = array("abc","acb","cba");
    //     $d = array('a','b','c');
    //     $a = [];
    //     for($i=1;$i<4;$i++){
    //         foreach($d as $v){
    //             $c = array(
    //                 $b[$i-1] => array($v)
    //             );
    //             array_push($c,$a);
    //             $a[$b[$i-1]][$v] = array(
    //                 "www".$i,"qqq".$i,"aaa".$i
    //             );
    //         }
           
    //     }
    //     var_dump($a);
    // }
}