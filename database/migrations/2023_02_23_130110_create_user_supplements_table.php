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
        Schema::create('user_supplements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('supplement_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('supplement_schedule'); //vervangt innameTijd
            $table->integer('amount');
            $table->timestamps();
        });

        DB::table('user_supplements')->insert(
            [
                [
                    'user_id' => 1,
                    'supplement_id' => 1,
                    'supplement_schedule' => "2023-05-16 09:00:00",
                    'amount' => 1,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 2,
                    'supplement_schedule' => "2023-05-16 12:00:00",
                    'amount' => 5,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 3,
                    'supplement_schedule' => "2023-05-16 15:00:00",
                    'amount' => 3,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 4,
                    'supplement_schedule' => "2023-05-16 17:00:00",
                    'amount' => 2,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 1,
                    'supplement_schedule' => "2023-05-15 08:00:00",
                    'amount' => 3,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 2,
                    'supplement_schedule' => "2023-05-15 16:00:00",
                    'amount' => 5,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 3,
                    'supplement_schedule' => "2023-05-15 06:00:00",
                    'amount' => 1,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 4,
                    'supplement_schedule' => "2023-05-15 20:00:00",
                    'amount' => 6,
                ],
                
                [
                    'user_id' => 1,
                    'supplement_id' => 1,
                    'supplement_schedule' => "2023-05-14 08:00:00",
                    'amount' => 1,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 2,
                    'supplement_schedule' => "2023-05-14 13:45:00",
                    'amount' => 5,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 3,
                    'supplement_schedule' => "2023-05-14 16:30:00",
                    'amount' => 3,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 4,
                    'supplement_schedule' => "2023-05-14 18:15:00",
                    'amount' => 2,
                ],
                
                [
                    'user_id' => 1,
                    'supplement_id' => 1,
                    'supplement_schedule' => "2023-05-17 10:00:00",
                    'amount' => 1,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 2,
                    'supplement_schedule' => "2023-05-17 11:00:00",
                    'amount' => 5,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 3,
                    'supplement_schedule' => "2023-05-17 13:30:00",
                    'amount' => 3,
                ],
                [
                    'user_id' => 1,
                    'supplement_id' => 4,
                    'supplement_schedule' => "2023-05-17 21:30:00",
                    'amount' => 2,
                ]
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
        Schema::dropIfExists('user_supplements');
    }
};
