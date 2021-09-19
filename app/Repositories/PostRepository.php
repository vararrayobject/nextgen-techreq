<?php
/**
 * @author Yogesh Gholap
 * @email yagholap@gmail.com
 * @create date 2021-09-19
 * @modify date 2021-09-19
 * @desc [description]
*/

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    private $model;

    /**
     * This function will return the model
     *
     */
    public function __construct(Post $model) {
       $this->model = $model;
    }

    public function all() {
        return $this->model->paginate(10);
    }
}