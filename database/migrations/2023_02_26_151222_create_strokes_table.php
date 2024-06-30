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
        Schema::create('strokes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('strokes')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'vlinderslag'
                ],
                [
                    'id' => 2,
                    'name' => 'baksteenslag'
                ],
                [
                    'id' => 3,
                    'name' => 'schoolslag'
                ],
                [
                    'id' => 4,
                    'name' => 'crawl'
                ],
                [
                    'id' => 5,
                    'name' => 'rugcrawl'
                ],
                [
                    'id' => 6,
                    'name' => 'vlinderslag'
                ],

            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strokes');
    }
};
