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
        Schema::create('user_series', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('series_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->float('time_travelled')->nullable();
            $table->dateTime('subscription_date')->default(now());
            $table->dateTime('confirmation_date')->nullable();
            $table->foreignId('status_id')->default("2")->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
        DB::table('user_series')->insert(
            [
                [
                    'id' => 1,
                    'user_id' => 1,
                    'series_id' => 1,
                    'time_travelled' => 200,
                    'subscription_date' => now(),
                    'confirmation_date' => now(),
                    'status_id'=>1
                ],
                [
                    'id' => 2,
                    'user_id' => 2,
                    'series_id' => 2,
                    'time_travelled' => 500,
                    'subscription_date' => now(),
                    'confirmation_date' => now(),
                    'status_id'=>2
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
        Schema::dropIfExists('user_series');
    }
};
