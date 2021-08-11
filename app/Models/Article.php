<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'text',
    ];

    /**
     * The user that belong to the article.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The categories that belong to the article.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
