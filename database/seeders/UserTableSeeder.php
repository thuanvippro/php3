<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345'),
            ],
            [
                'name' => 'thuận',
                'email' => 'thuannh@fpt.edu.vn',
                'password' => Hash::make('12345'),
            ],
        ];
        foreach($userData as $data){
            $model = new User();
            $model->fill($data);
            $model->save();
        }
    }
}
