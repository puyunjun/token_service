<?php

use Illuminate\Database\Seeder;
use App\Models\ApisInfo;

class ApisInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * api_route 接口路由
         * action_name 接口控制器及方法
         * title  接口名称
         * api_type 1=>开放类接口,0=>非开放类接口
         * api_url 接口url
         * method 接口请求方法
         * middleware 接口中间件
         * params 接口需要的参数
         */
        $data = [
            [   'api_route'=>'api.check.index',
                'action_name'=>'App\\Http\\Controllers\\Api\\AppletApis\\TestApiController@index',
                'title'=>'测试接口',
                'api_type'=>0,
                'api_url'=>'api/test',
                'method'=>'GET',
                'middleware'=>'api,api.before',
                'params'=>'token,sign,timestamp',
            ],
            [   'api_route'=>'api.check.test.show', 'action_name'=>'App\\Http\\Controllers\\Api\\AppletApis\\TestApiController@show',
                'title'=>'测试接口', 'api_type'=>0, 'api_url'=>'api/test/{id}', 'method'=>'GET', 'middleware'=>'api,api.before', 'params'=>'',
            ],
            [   'api_route'=>'api.login.index', 'action_name'=>'App\\Http\\Controllers\\Api\\AppletApis\\LoginController@index',
                'title'=>'登陆接口', 'api_type'=>1, 'api_url'=>'api/login', 'method'=>'GET', 'middleware'=>'api,api.before', 'params'=>'',
            ],
        ];
        $mysqlData = ApisInfo::select(['api_route', 'action_name', 'title', 'api_type', 'api_url', 'method', 'middleware', 'params'])->get()->toArray();

        array_filter($data,function ($v) use ($mysqlData){
            if(!in_array($v,$mysqlData)){
                //以路由信息为查询条件，数据库为唯一字段
                $apiRoute = array('api_route'=>$v['api_route']);
                unset($v['api_route']);
                ApisInfo::updateOrCreate($apiRoute, $v);
            }
        });

    }
}
