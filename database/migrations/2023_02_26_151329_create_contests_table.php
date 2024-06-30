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
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('date');
            $table->string('video_url');
            $table->foreignId('location_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('contests')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'Vlaamse kampioenschappen',
                    'date' => "2023-05-20",
                    'video_url' => 'https://youtube.com',
                    'location_id' => 1
                ],
                [
                    'id' => 2,
                    'name' => 'Antwerpse Kampioenschappen',
                    'date' => "2023-05-19",
                    'video_url' => 'https://youtube.com',
                    'location_id' => 2
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
        Schema::dropIfExists('contests');
    }
};
