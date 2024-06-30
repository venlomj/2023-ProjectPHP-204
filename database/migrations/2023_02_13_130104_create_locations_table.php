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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('city');
            $table->string('street');
            $table->string('postal_code');
            $table->string('street_number');
            $table->foreignId('country_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('locations')->insert(
            [
                [
                    'name' => 'Netepark',
                    'is_active' => true,
                    'city' => 'Herentals',
                    'street' => 'bornstraat',
                    'postal_code' => '2200',
                    'street_number' => '25',
                    'country_id' => 2
                ],
                [
                    'name' => 'Zwembad Turnhout',
                    'is_active' => true,
                    'city' => 'Turnhout',
                    'street' => 'Parklaan',
                    'postal_code' => '2300',
                    'street_number' => '1',
                    'country_id' => 2
                ],
                [
                    'name' => 'Centerparks limburg',
                    'is_active' => true,
                    'city' => 'Hasselt',
                    'street' => 'linielaan',
                    'postal_code' => '2000',
                    'street_number' => '195',
                    'country_id' => 2
                ],
                [
                    'name' => 'Centerparks Engeland',
                    'is_active' => true,
                    'city' => 'London',
                    'street' => 'Kings lane',
                    'postal_code' => '234567',
                    'street_number' => '22',
                    'country_id' => 5
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
        Schema::dropIfExists('locations');
    }
};
