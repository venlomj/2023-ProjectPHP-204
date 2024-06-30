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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_type_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('measurement_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string("name");
            $table->tinyInteger("is_active")->default(1);
            $table->timestamps();
        });

        // Insert some users (inside the up-function!)
        DB::table('products')->insert(
            [
                [
                    'product_type_id' => 1,
                    'measurement_id' => 1,
                    'name' => 'Revolution T-Shirt 1310 Fix',
                    'is_active' => true
                ],
                [
                    'product_type_id' => 2,
                    'measurement_id' => 2,
                    'name' => 'Zwemboxer voor heren Boxer 100 Plus zwart/blauw',
                    'is_active' => true
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
        Schema::dropIfExists('products');
    }
};
