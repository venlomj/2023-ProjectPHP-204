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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->time('start_time');
            $table->foreignId('contest_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('stroke_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('distance_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('sex_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('follow_number');
            $table->timestamps();
        });
        DB::table('series')->insert(
            [
                [
                    'id' => 1,
                    'start_time' => "16:00",
                    'contest_id' => 1,
                    'stroke_id' => 1,
                    'distance_id'=>1,
                    'sex_id'=>1,
                    'follow_number'=>1
                ],
                [
                    'id' => 2,
                    'start_time' => "16:00",
                    'contest_id' => 2,
                    'stroke_id' => 2,
                    'distance_id'=>2,
                    'sex_id'=>2,
                    'follow_number'=>2
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
        Schema::dropIfExists('series');
    }
};
