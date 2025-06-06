<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveEtatFromSeminairesTable extends Migration
{
    public function up(): void
    {
        Schema::table('seminaires', function (Blueprint $table) {
            $table->dropColumn('etat');
        });
    }

    public function down(): void
    {
        Schema::table('seminaires', function (Blueprint $table) {
            $table->string('etat')->nullable();
        });
    }
}
