<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * Get the post that the comment belongs to.
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
