<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Mews\Purifier\Facades\Purifier;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'user_id',
        'post_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * clean up the text attribute.
     */
    protected function text(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim(Purifier::clean($value)),
        );
    }

    /**
     * Get the user that owns the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'user_id',
        );
    }

    /**
     * Get the post that owns the comment.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(
            related: User::class,
            foreignKey: 'post_id',
        );
    }

    /**
     * Scope a query to include user and post related with the comment.
     */
    public function scopeReport(Builder $query): Builder
    {
        return $query->join('users', 'comments.user_id', '=', 'users.id')
        ->join('posts', 'comments.post_id', '=', 'posts.id')
        ->select(
            'comments.id',
            'comments.text',
            'users.name as user_name',
            'posts.title as post_title',
            \DB::raw('DATE_FORMAT(comments.created_at, "%d/%m/%Y") as date')
        );
    }
}
