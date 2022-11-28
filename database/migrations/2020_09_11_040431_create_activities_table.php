<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->date('date');            
            $table->foreignId('user_id')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('classification_id')->references('id')->on('classifications')
            ->onDelete('cascade');
            $table->foreignId('equipment_id')->references('id')->on('equipments')
            ->onDelete('cascade');
            $table->time('start_time');
            $table->time('finish_time');
            $table->text('description');
            $table->text('report');
            $table->foreignId('efficiency_id')->nullable()->references('id')->on('efficiencies')
            ->onDelete('cascade');
            $table->foreignId('competency_id')->nullable()->references('id')->on('competencies')
            ->onDelete('cascade');
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
        Schema::dropIfExists('activities');
        
    }
}
