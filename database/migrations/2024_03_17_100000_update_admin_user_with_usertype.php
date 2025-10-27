<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up()
    {
        // First, delete any existing admin user to avoid duplicates
        DB::table('users')->where('email', 'admin@mtcagua.com')->delete();

        // Create a new admin user with the correct usertype
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mtcagua.com',
            'password' => Hash::make('admin123'),
            'usertype' => 'admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        DB::table('users')->where('email', 'admin@mtcagua.com')->delete();
    }
};