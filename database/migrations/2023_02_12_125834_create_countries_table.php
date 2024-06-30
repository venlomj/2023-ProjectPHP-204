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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('countries')->insert(
            [
                [
                    'name' => 'Nederland'
                ],
                [
                    'name' => 'België'
                ],
                [
                    'name' => 'Duitsland'
                ],
                [
                    'name' => 'Frankrijk'
                ],
                [
                    'name' => 'Engeland'
                ],
                [
                    'name' => 'Luxemburg'
                ],
                [
                    'name' => 'Denemarken'
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
        Schema::dropIfExists('countries');
    }
};
