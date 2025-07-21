<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\User;
use App\Models\UserPosition;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'admin')->first();
        $position = Position::where('name', 'Administrator')->first();

        if (!$user) {
            $this->command->warn('Admin user not found. Please create an admin user first.');
            return;
        }
        if (!$position) {
            $this->command->warn('Administrator position not found. Please create a position first.');
            return;
        }

        UserPosition::create([
            'uuid' => (string) \Illuminate\Support\Str::uuid(),
            'user_id' => $user->uuid,
            'position_id' => $position->uuid,
        ]);

        $this->command->info('UserPositions seeded successfully!');
    }
}
