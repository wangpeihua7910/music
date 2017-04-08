<?php
//引入配置文件
//定义一个wechat类，用来储存微信接口的方法
class Wechat{
    private $appid;
    private $appsecret;
    //实例化触发一个方法
    public function _construct(){
        $this->appid = APPID;
        $this->appsecret= APPSECRET ;
    }
    public function request($url,$https=true,$method='get',$data=null){
        //1.初始化
        $ch =curl_init($url);
        //2.设置curl
        //返回数据不输出
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        //满足https
        if($https === true){
         //绕过ssl验证
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }
        //满足post
        if($method === 'post'){
          curl_setopt($ch, CURLOPT_POST, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        //3.发送请求
        $content = curl_exec($ch);
        //4.关闭资源
        curl_close($ch);
        return $content;
    }
    //获取access_token
    public function getAccessToken(){
        //1.url
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appid&secret=$this->appsecret";
        //2.请求方式
        //3.发送请求
        $content = $this->request($url);
        //4.返回值吃力

    }
}
