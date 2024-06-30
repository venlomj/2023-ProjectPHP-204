<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('federation_number')->nullable();
            $table->date('birth_date');
            $table->date('start_date');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_financial_administrator')->default(false);
            $table->boolean('is_coach')->default(false);
            $table->boolean('is_swimmer')->default(false);
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('is_active')->default(false);
            $table->foreignId('sex_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('current_team_id')->nullable();
            $table->foreignId('coach_id')->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'phone_number' => '02588489863',
                    'email' => 'john.doe@example.com',
                    'federation_number' => 'BE2300',
                    'birth_date' => now(),
                    'start_date' => now(),
                    'email_verified_at' => now(),
                    'password' => Hash::make('admin1234'),
                    'is_admin' => true,
                    'is_financial_administrator' => false,
                    'current_team_id' => 1,
                    'coach_id' => 1,
                    'is_swimmer' => true,
                    'is_coach' => true,
                    'sex_id' => 1,
                    'location_id' => 1,
                    'profile_photo_path' => 'https://trouwen.nl/inspiratie/kleding-bruiloft-gast-man-bruiloft-zonder-dresscode',
                    'is_active' => true,
                ],
                [
                    'first_name' => 'Murrel',
                    'last_name' => 'Venlo',//voorlopig
                    'phone_number' => '02588489863',
                    'email' => 'r0781309@student.thomasmore.be',
                    'federation_number' => 'BE2360',
                    'birth_date' => now(),
                    'start_date' => now(),
                    'email_verified_at' => now(),
                    'password' => Hash::make('mj1724'),
                    'is_admin' => false,
                    'is_financial_administrator' => false,
                    'current_team_id' => 1,
                    'coach_id' => 1,
                    'is_swimmer' => true,
                    'is_coach' => false,
                    'sex_id' => 1,
                    'location_id' => 1,
                    'profile_photo_path' => '',
                    'is_active' => true,
                ],
                [
                    'first_name' => 'Josse',
                    'last_name' => 'Van Looy',//voorlopig
                    'phone_number' => '654484515',
                    'email' => 'josse@test.be',
                    'federation_number' => 'BE2400',
                    'birth_date' => now(),
                    'start_date' => now(),
                    'email_verified_at' => now(),
                    'password' => Hash::make('user1234'),
                    'is_admin' => true,
                    'is_financial_administrator' => false,
                    'current_team_id' => 1,
                    'coach_id' => 1,
                    'is_swimmer' => true,
                    'is_coach' => false,
                    'sex_id' => 1,
                    'location_id' => 1,
                    'profile_photo_path' => '',
                    'is_active' => true,
                ],
                [
                    'first_name' => 'Tom',
                    'last_name' => 'Vermeeren',//voorlopig
                    'phone_number' => '16484654648',
                    'email' => 'tom@test.be',
                    'federation_number' => 'BE2560',
                    'birth_date' => now(),
                    'start_date' => now(),
                    'email_verified_at' => now(),
                    'password' => Hash::make('user1234'),
                    'is_admin' => false,
                    'is_financial_administrator' => false,
                    'current_team_id' => 1,
                    'coach_id' => 1,
                    'is_swimmer' => false,
                    'is_coach' => true,
                    'sex_id' => 1,
                    'location_id' => 1,
                    'profile_photo_path' => '',
                    'is_active' => true,
                ],
                [
                    'first_name' => 'Bram',
                    'last_name' => 'Augenbroe',//voorlopig
                    'phone_number' => '195898498798',
                    'email' => 'bram@test.be',
                    'federation_number' => 'BE2000',
                    'birth_date' => now(),
                    'start_date' => now(),
                    'email_verified_at' => now(),
                    'password' => Hash::make('user1234'),
                    'is_admin' => false,
                    'is_financial_administrator' => true,
                    'current_team_id' => 1,
                    'coach_id' => 1,
                    'is_swimmer' => false,
                    'is_coach' => false,
                    'sex_id' => 1,
                    'location_id' => 1,
                    'profile_photo_path' => '',
                    'is_active' => true,
                ]
                ,[
                    'first_name' => 'Kam',
                    'last_name' => 'Kamd',//voorlopig
                    'phone_number' => '564148468',
                    'email' => 'kamd@test.be',
                    'federation_number' => 'BE2020',
                    'birth_date' => now(),
                    'start_date' => now(),
                    'email_verified_at' => now(),
                    'password' => Hash::make('user1234'),
                    'is_admin' => false,
                    'is_financial_administrator' => false,
                    'current_team_id' => 1,
                    'coach_id' => 1,
                'is_swimmer' => true,
                'is_coach' => false,
                    'sex_id' => 2,
                    'location_id' => 1,
                    'profile_photo_path' => '',
                    'is_active' => true,
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
