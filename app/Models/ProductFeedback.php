<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ProductFeedback extends Model
{
    use HasFactory, Sortable;

    protected $table = "product_feedback";

    protected $fillable = ['title', 'category', 'feed_back', 'feature_request', 'vote_count', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Correct the relationship method name to match the foreign key in the comments table
    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id', 'id');
    }
}
