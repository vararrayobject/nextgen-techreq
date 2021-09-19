<?php
/**
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-19
 * @modify date 2021-09-19
 * @desc [description]
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartDetail extends Model
{
    use HasFactory;

    public function techReqs()
    {
        return $this->hasMany('App\Models\TechRequirement');
    }
}
