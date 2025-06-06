<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{   Schema::table('seminaires', function (Blueprint $table) {
        $table->time('date')->change();
    
    });
}

public function down()
{
    
    Schema::table('seminaires', function (Blueprint $table) {
        $table->dateTime('date')->change();
    });
}
};
