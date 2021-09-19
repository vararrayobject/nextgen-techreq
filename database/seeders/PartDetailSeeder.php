<?php
/**
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-19
 * @modify date 2021-09-19
 * @desc [description]
*/

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PartDetail;
use App\Models\User;

class PartDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PartDetail::create([
            'user_id' => User::first()->id,
            'number' => '1000',
            'name' => 'Part 1000',
        ]);

        PartDetail::create([
            'user_id' => User::first()->id,
            'number' => '1001',
            'name' => 'Part 1001',
        ]);

        PartDetail::create([
            'user_id' => User::first()->id,
            'number' => '1002',
            'name' => 'Part 1002',
        ]);
    }
}
