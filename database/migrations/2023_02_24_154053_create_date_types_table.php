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
        Schema::create('date_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('date_types')->insert(
            [
                [
                    'name' => 'maandag',
                ],
                [
                    'name' => 'dinsdag',
                ],
                [
                    'name' => 'woensdag',
                ],
                [
                    'name' => 'donderdag',
                ],
                [
                    'name' => 'vrijdag',
                ],
                [
                    'name' => 'zaterdag',
                ],
                [
                    'name' => 'zondag',
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
        Schema::dropIfExists('date_types');
    }
};
