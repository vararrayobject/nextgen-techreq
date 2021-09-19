<?php
/**
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-20
 * @modify date 2021-09-20
 * @desc [description]
*/

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('test123'),
        ]);
    }
}
