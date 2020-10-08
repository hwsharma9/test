<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
    	'user_id',
    	'title',
    	'slug',
    	'description',
    	'featured_image'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function tags($name='')
    {
    	return $this->hasMany(Tag::class);
    }
}
