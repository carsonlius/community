<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsersAddColumnSocial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('social_type', 30)->default(null)->nullable()->comment('第三方登录的类型:github weibo');
            $table->unsignedInteger('social_id')->default(null)->nullable()->comment('第三方登录的id');
            $table->unique(['social_type', 'social_id'], 'third_login');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('third_login');
            $table->dropColumn('social_type');
            $table->dropColumn('social_id');
        });
    }
}
