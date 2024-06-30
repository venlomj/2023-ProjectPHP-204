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
        Schema::create('distances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        DB::table('distances')->insert(
            [
                [
                    'id' => 1,
                    'name' => '500m'
                ],
                [
                    'id' => 2,
                    'name' => '200m'
                ],
                [
                    'id' => 3,
                    'name' => '100m'
                ],
                [
                    'id' => 4,
                    'name' => '300m'
                ],
                [
                    'id' => 5,
                    'name' => '400m'
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
        Schema::dropIfExists('distances');
    }
};
