<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        // Delete all admin users
        User::where('usertype', 'admin')->delete();

        // Create single admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mtcagua.com',
            'password' => Hash::make('admin123'),
            'usertype' => 'admin',
            'email_verified_at' => now(),
        ]);
    }

    public function down(): void
    {
        // In down(), we'll restore the original state with both admin users
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
};