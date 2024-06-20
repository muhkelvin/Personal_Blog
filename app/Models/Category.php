<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug'
    ];

    public function posts() // Relationship name should be plural for one-to-many
    {
        return $this->hasMany(Post::class); // Use hasMany for a one-to-many relationship
    }
}
