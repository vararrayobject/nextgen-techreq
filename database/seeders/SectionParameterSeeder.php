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
use App\Models\SectionParameter;

class SectionParameterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Type 1
        SectionParameter::create([
            'parameter' => 'Parameter 1',
            'section_id' => 1,
        ]);
        
        SectionParameter::create([
            'parameter' => 'Parameter 2',
            'section_id' => 1,
        ]);

        SectionParameter::create([
            'parameter' => 'Parameter 3',
            'section_id' => 1,
        ]);
        
        SectionParameter::create([
            'parameter' => 'Parameter 4',
            'section_id' => 1,
        ]);

        // Type 2
        SectionParameter::create([
            'parameter' => 'C',
            'section_id' => 2,
        ]);
        
        SectionParameter::create([
            'parameter' => 'Mn',
            'section_id' => 2,
        ]);

        SectionParameter::create([
            'parameter' => 'Cr',
            'section_id' => 2,
        ]);
        
        SectionParameter::create([
            'parameter' => 'P',
            'section_id' => 2,
        ]);

        SectionParameter::create([
            'parameter' => 'S',
            'section_id' => 2,
        ]);

        SectionParameter::create([
            'parameter' => 'Si',
            'section_id' => 2,
        ]);

        SectionParameter::create([
            'parameter' => 'Ni',
            'section_id' => 2,
        ]);

        SectionParameter::create([
            'parameter' => 'Al',
            'section_id' => 2,
        ]);

        SectionParameter::create([
            'parameter' => 'Bo',
            'section_id' => 2,
        ]);

        SectionParameter::create([
            'parameter' => 'Cu',
            'section_id' => 2,
        ]);

        SectionParameter::create([
            'parameter' => 'Sn',
            'section_id' => 2,
        ]);

        SectionParameter::create([
            'parameter' => 'V',
            'section_id' => 2,
        ]);
    }
}
