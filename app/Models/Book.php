<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'image_url',
        'release_year',
        'price',
        'total_page',
        'thickness',
        'category_id',
    ];

    // foreign key
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

}
