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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_period_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->boolean("paid")->default(false);
            $table->timestamps();
        });

        DB::table('orders')->insert(
            [
                [
                    "order_period_id" => 1,
                    "user_id" => 1,
                    'paid' => false
                ],
                [
                    "order_period_id" => 2,
                    "user_id" => 1,
                    'paid' => false
                ],
                [
                    "order_period_id" => 1,
                    "user_id" => 1,
                    'paid' => true
                ],
                [
                    "order_period_id" => 2,
                    "user_id" => 2,
                    'paid' => false
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
        Schema::dropIfExists('orders');
    }
};
