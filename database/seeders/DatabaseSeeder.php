<?php
/**
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-20
 * @modify date 2021-09-20
 * @desc [description]
*/

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            PartDetailSeeder::class,
            SectionSeeder::class,
            SectionParameterSeeder::class,
        ]);
    }
}
