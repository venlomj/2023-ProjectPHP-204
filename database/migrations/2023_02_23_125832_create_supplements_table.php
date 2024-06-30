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
        Schema::create('supplements', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();;
            $table->string('unit');
            $table->timestamps();
        });

        DB::table('supplements')->insert(
            [
                [
                    'name' => 'sportdrank',
                    'unit' => 'ml'
                ],
                [
                    'name' => 'energiereep',
                    'unit' => 'g'
                ],
                [
                    'name' => 'banaan',
                    'unit' => 'g'
                ],
                [
                    'name' => 'appel',
                    'unit' => 'g'
                ],
                [
                    'name' => 'caffeïne pil',
                    'unit' => 'mg'
                ],
                [
                    'name' => 'druif',
                    'unit' => 'g'
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
        Schema::dropIfExists('supplements');
    }
};
