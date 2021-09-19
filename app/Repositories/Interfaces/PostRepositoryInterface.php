<?php
/**
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-19
 * @modify date 2021-09-19
 * @desc [description]
 */

namespace App\Repositories\Interfaces;

use App\Models\Post;

interface PostRepositoryInterface
{
    /**
     * all
     *
     * @return void
     */
    public function all();

    // /**
    //  * Create Post
    //  *
    //  * @return void
    //  */
    // public function create($post);
}