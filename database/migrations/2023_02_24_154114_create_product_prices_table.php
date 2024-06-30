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
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->float("price", 5, 2);
            $table->date("valid_since");
            $table->timestamps();
        });

        DB::table('product_prices')->insert(
            [
                [
                    'product_id' => 1,
                    'price' => 19.99,
                    'valid_since' => "2023-04-19"
                ],
                [
                    'product_id' => 2,
                    'price' => 29.99,
                    'valid_since' => "2023-04-19"
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
        Schema::dropIfExists('product_prices');
    }
};
