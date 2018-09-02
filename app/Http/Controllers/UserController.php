<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Apply;
use App\Skill;
use App\Connect;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    /**
     * 用户注册数据存储
     */
    public function register(Request $request)
    {
        //表单验证
         $this->validate($request,[
             'username'=>'required|unique:users',
             'password'=>'required',
             'contact'=>'required',
             'phone'=>'required',
             'email'=>'required|email'
         ],[
             'username.required'=>'用户名不能为空',
             'username.unique'=>'用户名已存在',
             'password.required'=>'密码不能为空',
             'contact.required'=>'联系人不能为空',
             'phone.required'=>'联系方式不能为空',
             'email.required'=>'邮箱地址不能为空',
             'email.email'=>'邮箱格式不正确'
         ]);
        //数据插入
        $user = new User;
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->contact = $request->input('contact');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        if($user->save()){
            return $this->returnMsg('200','ok');
        }else{
            return $this->returnMsg('5000','create failed');
        }
    }
    /**
     * 用户登录
     */
    public function login(Request $request)
    {
        //实例化用户对象
        $user = User::where('username',$request->username)->firstOrFail();
        //$user = User::where('username',$request->input('username'))->findOrFail();
        //判断该用户是否已经注册
        if(!empty($user)){
            //检查密码是否正确
            if(Hash::check($request->password,$user->password)){
                return $this->returnMsg('200','ok',$user);
            }else{
                return $this->returnMsg('500','wrong password',[]);
            }
        }else{
            return $this->returnMsg('500','no user matched',[]);
        }
    }

    /**
     * 用户注销登录
     */
    public function logout(Request $request)
    {
        //删除数据
        $request->session()->flush();
        return $this->reutrnMsg('200','ok');
    }

    /**
     * 合作
     */
    public function cooperate(Request $request)
    {
        //检验表单内容
        $messages = [
            'required' => '请完善填写内容',
            'email.email'=>'邮箱格式不正确',
        ];
        $request->validate([
            'cname'=>'required',
            'address'=>'required',
            'name'=>'required',
            'phone'=>'required',
            'type'=>'required',
            'intro'=>'required',
            'license'=>'required',
            'content'=>'requierd',
            'property'=>'required',
            'fund'=>'required',
        ],$messages);
       //存储上传的图片
       $path = $request->file('license')->store('cooperate');
       //存储上传的信息
       $apply = new Apply;
       $apply->cname = $request->input('cname');
       $apply->address = $request->input('address');
       $apply->name = $request->input('name');
       $apply->phone = $request->input('phone');
       $apply->type = $request->input('type');
       $apply->intro = $request->input('intro');
       $apply->license = $path;
       $apply->content = $request->input('content');
       $apply->property = $request->input('property');
       $apply->fund = $request->input('fund');

       //插入数据表
       if($apply->save()){
           return $this->returnMsg('200','ok');
       }else{
           return $this->returnMsg('5000','create failed');
       }
    }

    /**
     * 技术咨询
     */
    public function skill(Request $request)
    {
        $request->validate([
            'email'=>'email',
            'spec_email'=>'email'
        ],[
            'email.email'=>'邮箱格式不正确',
            'spec_email'=>'邮箱格式不正确'
        ]);
        $skill = new Skill;
        $skill->cname = $request->input('cname');
        $skill->name = $request->input('name');
        $skill->phone = $request->input('phone');
        $skill->email = $requst->input('email');
        $skill->product = $request->input('product');
        $skill->content = $request->input('content');
        $skill->spec_email = $request->input('spec_email');

        if($skill->save()){
            return $this->returnMsg('200','ok');
        }else{
            return $this->returnMsg('5000','created failed');
        }
    }

    /**
     * 在线留言
     */
    public function connect(Request $request)
    {
        $request->validate([
            'email'=>'email'
        ],[
            'email.email'=>'邮箱格式不正确'
        ]);
        $connect = new Connect;
        $connect->name = $request->input('name');
        $connect->phone = $request->input('phone');
        $connect->email = $requst->input('email');
        $connect->message = $request->input('message');

        if($connect->save()){
            return $this->returnMsg('200','ok');
        }else{
            return $this->returnMsg('5000','created failed');
        }
    }
    public function show()
    {
        $user = User::find(session('uid'));
        return $this->returnMsg('200','ok',$user);
    }
}