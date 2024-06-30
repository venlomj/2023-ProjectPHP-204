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
        Schema::create('training_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();;
            $table->timestamps();
        });

        DB::table('training_types')->insert(
            [
                [
                    'name' => 'krachttraining',
                ],
                [
                    'name' => 'zwemtraining',
                ],
                [
                    'name' => 'afstandtraining',
                ],
                [
                    'name' => 'conditietraining',
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
        Schema::dropIfExists('training_types');
    }
};
