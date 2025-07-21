<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('username', 'admin')->first();

        if (!$adminUser) {
            $this->command->error('Admin user not found. Please create an admin user first.');
            $adminUser = User::create([
                'uuid' => (string) \Illuminate\Support\Str::uuid(),
                'name' => 'Admin User',
                'username' => 'admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
            ]);
            $this->command->info('Admin user created.');
        }

        Position::create([
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'name' => 'Administrator',
        ]);
        $this->command->info('Position table seeded with Administrator position for admin user.');
    }
}
