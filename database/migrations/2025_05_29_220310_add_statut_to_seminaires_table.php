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
{
    Schema::table('seminaires', function (Blueprint $table) {
        $table->string('statut')->default('en attente');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seminaires', function (Blueprint $table) {
            //
        });
    }
};
