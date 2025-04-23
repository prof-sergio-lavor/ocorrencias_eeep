<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('motivos_ocorrencias', function (Blueprint $table) {
        $table->enum('gravidade', ['leve', 'média', 'grave'])->default('leve');
    });
}

public function down()
{
    Schema::table('motivos_ocorrencias', function (Blueprint $table) {
        $table->dropColumn('gravidade');
    });
}

};
