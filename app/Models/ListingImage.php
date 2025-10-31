<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['filename'];
    protected $appends = ['src'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(
            Listing::class
        );
    }

    // getRealSrcAttribute -> real_src
    public function getSrcAttribute()
    {
        // Return a relative URL to avoid APP_URL/host mismatches
        return '/storage/' . ltrim($this->filename, '/');
    }
}
