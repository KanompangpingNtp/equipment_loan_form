<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com', // เปลี่ยนเป็นอีเมลที่คุณต้องการ
            'password' => Hash::make('123456789'), // เปลี่ยนเป็นรหัสผ่านที่คุณต้องการ
            'level' => 'admin',
        ]);
    }
}
