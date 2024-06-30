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
        Schema::create('order_periods', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->date("begin_date");
            $table->date("end_date");
            $table->timestamps();
        });

        DB::table('order_periods')->insert(
            [
                [
                    'name' => 'Vlaams kampioenschap',
                    'begin_date' => "2023-05-19 09:00:00",
                    'end_date' => "2023-05-19 17:00:00"
                ],
                [
                    'name' => 'Belgisch kampioenschap',
                    'begin_date' => "2023-05-20 09:00:00",
                    'end_date' => "2023-05-20 17:00:00"
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
        Schema::dropIfExists('order_periods');
    }
};
