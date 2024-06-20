<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','slug','body','category_id','excerpt','user_id','image'
    ];

    public function category() // Relationship name should be singular
    {
        return $this->belongsTo(Category::class); // Use belongsTo for a one-to-many relationship
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
