<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('NIK');
            $table->string('password');
            $table->foreignId('position_id')->nullable()->references('id')->on('positions')
            ->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->references('id')->on('departments')
            ->onDelete('cascade');
            $table->foreignId('leader_id')->nullable()->references('id')->on('leaders')
            ->onDelete('cascade');
            $table->foreignId('role_id')->nullable()->references('id')->on('roles')
            ->onDelete('cascade');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        // $table->dropForeign(['position_id']);
        // $table->dropForeign(['role_id']);
        
        
    }
}
