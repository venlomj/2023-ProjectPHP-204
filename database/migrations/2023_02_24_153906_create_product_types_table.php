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
        Schema::create('product_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("fotoUrl");
            $table->timestamps();
        });

        // Insert some users (inside the up-function!)
        DB::table('product_types')->insert(
            [
                [
                    'name' => 't-shirt',
                    'fotoUrl' => 'https://www.asadventure.com/nl/p/revolution-t-shirt-1310-fix-A12BAC0564.html?colour=10918'
                ],
                [
                    'name' => 'zwembroek',
                    'fotoUrl' => 'https://www.decathlon.be/nl/p/zwemboxer-voor-heren-boxer-100-plus/_/R-p-333680?mc=8647088&c=ZWART'
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
        Schema::dropIfExists('product_types');
    }
};
