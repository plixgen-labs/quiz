<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text', 'hint', 'image', 'bgimage', 'difficulty', 'answer', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
