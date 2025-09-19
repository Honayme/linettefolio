<?php

namespace App\Models;

use App\Enums\PortfolioLayout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PortfolioItem extends Model
{
    use HasFactory;


    protected $fillable = [
        'category_id',
        'title',
        'description',
        'layout',
        'cover_image',
        'cover_image_alt',
        'images',
        'video_file',
        'pdf_file',
        'is_visible',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'images' => 'array',
        'is_visible' => 'boolean',
        'layout' => PortfolioLayout::class, // Ajouté ici
    ];

    /**
     * The categories that belong to the PortfolioItem.
     *
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_portfolio_item');
    }

    /**
     * Get the video URL for the frontend
     */
    public function getVideoUrlAttribute(): ?string
    {
        if (!$this->video_file) {
            return null;
        }

        return asset('storage/' . $this->video_file);
    }

    /**
     * Check if this item has a video
     */
    public function hasVideo(): bool
    {
        return !empty($this->video_file);
    }
}
