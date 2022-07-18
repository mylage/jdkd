<?php
namespace Jdkd;

class Jdkd
{
    public $error = '';
    public $app_key = 'dc88920d82764c20b6b03e18fa45dbac';
    public $app_secret = '9980cc6e9f524d3fb02ae7e7d4b4f6a3';
    public $access_token = 'c87dc689826c430986be3100fa7e85ed';//'cd9e89a925764c98b7a3e49a626eabe4';
    public $base_url = 'https://test-api.jdl.cn';// 生产环境: https://api.jdl.com
    public $domain = '010K10019';
    public $version = "2.0";//API协议版本，固定值：2.0
    public function __construct($app_key,$app_secret,$access_token,$base_url,$domain){
        $this->app_key = $app_key;
        $this->app_secret = $app_secret;
        $this->access_token = $access_token;
        $this->base_url = $base_url;
        $this->domain = $domain;
    }
    //验签
    public function generate_sign($method, $timestamp, $param_json)
    {
        $content = $this->app_secret . "access_token" . $this->access_token . "app_key" . $this->app_key . "method" . $method .
            "param_json" . $param_json . "timestamp" . $timestamp . "v" . $this->version . $this->app_secret;
        return strtoupper(md5($content));
    }
    //发送请求
    public function send_request($path,$request_body)
    {
        date_default_timezone_set("Asia/Shanghai");
        $timestamp = strftime("%Y-%m-%d %H:%M:%S");
        $sign = $this->generate_sign($path, $timestamp, $request_body);
        $query = http_build_query(array(
            "access_token" => $this->access_token,
            "app_key" => $this->app_key,
            "method" => $path,
            "timestamp" => $timestamp,
            "v" => $this->version,
            "sign" => $sign,
            "LOP-DN" => $this->domain
        ));
        $url = $this->base_url . "/" . $path . "?" . $query;
        $result = httpCurl($url,$request_body,'POST',[],true);
        return $result;

    }

    public function JdOrder($path,$body){
        $request_body = json_encode($body,JSON_UNESCAPED_UNICODE);
        $result = $this->send_request($path,$request_body);
        return $result;
    }

}