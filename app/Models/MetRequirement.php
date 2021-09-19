<?php
/**
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-20
 * @modify date 2021-09-20
 * @desc [description]
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetRequirement extends Model
{
    use HasFactory;

    public function partDetail()
    {
        return $this->belongsTo('App\Models\PartDetail');
    }
}
