<?php

namespace App\Models;

use App\Enums\ProjectStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory, Sluggable, SoftDeletes;

    protected $fillable = ['name', 'slug', 'status', 'description', 'is_active', 'category_id', 'user_id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'status' => ProjectStatus::class,
            ]
        ];
    }

    /**
     * category
     *
     * @return BelongsTo<Category>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * user
     *
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * tasks
     *
     * @return HasMany<Task>
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * assignments
     *
     * @return HasManyThrough<Assignment, Task>
     */
    public function assignments(): HasManyThrough
    {
        return $this->hasManyThrough(Assignment::class, Task::class);
    }

    /**
     * casts
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'status' => ProjectStatus::class,
        ];
    }
}
