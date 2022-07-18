#京东快递SDK
<!-- TOC -->
- [SDK规范](#sdk规范)
- [接口调用示例](#接口调用示例)
- [命令行工具](#命令行工具)
- [拼多多文档](#拼多多文档)
- [京东文档](#京东文档)
<!-- /TOC -->
> 禁止把平台的sdk，直接全部复制进来,所有类必须整理为符合psr4加载规范的要求

## SDK规范

>此sdk包为各项目独立引用包，不要在里面写默认配置, 类似site('xxx_app_key')等。

- 接口添加完后要至少加一个单元测试,做为用法示例

- 各平台的类名字或命名空间，为了跟其它原有项目中做区分，使用全拼， ，比如 京东 命名使用 jingdong

- 各平台涉及到**appKey,key,appid,appSecret,client_id,client_secret accessToken,sessionKey**等，统一为 **appKey,appSecret,accessToken,[options](其它项)**

- 客户端实例化时传入**appKey,appSecret,options**,全为非必传，扩展配置可使用**options**传入，详细处理逻辑可看**QingYa\UnionSdk\SdkClient**构造方法

## 接口调用示例

接口调用封装成统一的调用流程(视情况而定),如下，构造函数接收三个入参，第三个入参为数组，且可覆盖类成员属性(扩展用)

```php
// 创建客户端
$client=new Jdkd(self::$jdAppKey, self::$jdAppSecret,self::$access_token,self::$base_url,self::$domain);
// 创建接口请求对象
$response = $client::JdOrder(self::$path,self::$body);
```

### 京东快递文档

文档地址：<https://cloud.jdl.com/#/open-business-document/api-doc/158/198>  

