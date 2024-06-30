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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->boolean('is_sent')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('training_type_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('trainings')->insert(
            [
                [
                    'start_time' => "2023-05-16 09:00:00",
                    'end_time' => "2023-05-16 10:00:00",
                    'is_sent' => true,
                    'user_id' => 1,
                    'training_type_id' => 1,
                    'location_id' => 1
                ],
                [
                    'start_time' => "2023-05-15 12:00:00",
                    'end_time' => "2023-05-15 14:00:00",
                    'is_sent' => true,
                    'user_id' => 1,
                    'training_type_id' => 2,
                    'location_id' => 2
                ],
                [
                    'start_time' => "2023-05-14 15:00:00",
                    'end_time' => "2023-05-14 17:00:00",
                    'is_sent' => true,
                    'user_id' => 1,
                    'training_type_id' => 3,
                    'location_id' => 3
                ],
                [
                    'start_time' => "2023-05-17 09:00:00",
                    'end_time' => "2023-05-17 12:00:00",
                    'is_sent' => true,
                    'user_id' => 1,
                    'training_type_id' => 3,
                    'location_id' => 3
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
        Schema::dropIfExists('trainings');
    }
};
