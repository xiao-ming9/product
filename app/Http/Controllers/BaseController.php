<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     * 统一api返回格式
     * 
     * @param string $code    状态码
     * @param string $message 信息
     * @param string $data    数据
     * 
     * @return void
     */
    public function returnMsg($code='200',$message='ok',$data=null)
    {
        $result['status_code'] = $code;
        $result['message'] = $message;
        $result['data'] = $data;
        return $result;
    }
}
