<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedUsers = [
            ["id" => "1",'name' => 'Ad Ministrator','eMail' => 'admin@example.com','password' => 'Password1!'],
            ["id" => "2",'name' => 'KokWei Low','eMail' => 'kokwei@example.com','password' => 'Password1!'],
            ["id" => "45",'name' => 'Jacques d’Carre','eMail' => 'jacques@example.com','password' => 'Password1!'],
            ["id" => "46",'name' => 'Dee Leet','eMail' => 'dee@example.com','password' => 'Password1!'],
            ["id" => "47",'name' => 'Eileen Dover','eMail' => 'eileen@example.com','password' => 'Password1!'],
            ["id" => "48",'name' => 'Booker Holliday','eMail' => 'booker@example.com','password' => 'Password1!'],
            ["id" => "49",'name' => 'Fallon Dover','eMail' => 'fallon@example.com','password' => 'Password1!'],
        ];
        foreach ($seedUsers as $seedUser) {
            $seedUser['password']=Hash::make($seedUser['password']);
            User::create($seedUser);
        }
    }
}
