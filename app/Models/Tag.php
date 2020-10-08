<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'name'];

    public function posts()
    {
    	return $this->belongsTo(Post::class, 'post_id');
    }
}
