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
        Schema::create('measurements', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        // Insert some users (inside the up-function!)
        DB::table('measurements')->insert(
            [
                [
                    'name' => 'Small',
                ],
                [
                    'name' => 'Medium',
                ],
                [
                    'name' => 'Large',
                ],
                [
                    'name' => 'XL',
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
        Schema::dropIfExists('measurements');
    }
};
