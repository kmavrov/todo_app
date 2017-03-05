<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';


    /**
     * Get the comments for the blog post.
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
