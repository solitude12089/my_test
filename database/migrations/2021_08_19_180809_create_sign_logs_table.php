<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('sign');
            foreach (['all','love','job','lucky'] as $key => $value){
                $table->integer($value.'_count');
                $table->string($value.'_note');
            }
           
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
        Schema::dropIfExists('sign_logs');
    }
}
