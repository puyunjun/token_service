<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGdyApisInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*[   'api_route'=>'api.check.index',
            'action_name'=>'App\\Http\\Controllers\\Api\\AppletApis\\TestApiController@index',
            'title'=>'测试接口',
            'api_type'=>'1',
            'api_url'=>'api/test',
            'method'=>'GET',
            'middleware'=>'api,api.before'
        ];*/
        Schema::create('gdy_apis_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('api_route',20)->comment('api路由信息')->unique();
            $table->string('action_name',100)->nullable()->default('')->comment('接口控制器及方法');
            $table->string('title',20)->nullable()->default('')->comment('接口名称');
            $table->string('api_url',100)->nullable()->default('')->comment('接口url');
            $table->string('method',20)->default('GET')->comment('接口请求方法');
            $table->string('middleware',100)->default('')->comment('接口使用的中间件');
            $table->unsignedTinyInteger('api_type')->default(1)->comment('接口类型,0=>非开放类接口,1=>开放类接口');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gdy_apis_info');
    }
}
