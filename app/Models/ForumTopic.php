<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Builder;

class ForumTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'views_count',
        'is_pinned',
        'is_hot',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'is_hot' => 'boolean',
        'views_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ForumCategory::class, 'category_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ForumReply::class, 'topic_id');
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(ForumLike::class, 'likeable');
    }

    public function bookmarks(): HasMany
    {
        return $this->hasMany(ForumBookmark::class, 'topic_id');
    }

    // Scopes for sorting
    public function scopePopular(Builder $query)
    {
        // Popular = complex mix, but let's stick to views + replies count?
        // Or just views count as requested "most views/likes"
        return $query->withCount('likes')->orderByDesc('views_count')->orderByDesc('likes_count');
    }

    public function scopeHot(Builder $query)
    {
        // Explicitly hot OR calculated dynamic logic
        return $query->where('is_hot', true)
            ->orWhere(function ($q) {
                $q->where('created_at', '>=', now()->subDays(7))
                    ->has('replies', '>=', 10); // Simple logic: created within 7 days AND has > 10 replies
            });
    }
}
