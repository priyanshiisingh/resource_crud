<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sharks', function (Blueprint $table) {
            //
            Schema::create('sharks', function(Blueprint $table)
        {
            $table->increments('id');

            $table->string('name', 255);
            $table->string('email', 255);
            $table->integer('shark_level');

            $table->timestamps();
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sharks', function (Blueprint $table) {
            //
        });
    }
};
