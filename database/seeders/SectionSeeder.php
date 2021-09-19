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
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::create([
            'name' => 'Section A',
            'type' => 1,
        ]);

        Section::create([
            'name' => 'Section B',
            'type' => 2,
        ]);
    }
}
