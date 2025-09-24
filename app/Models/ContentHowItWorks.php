<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentHowItWorks extends Model
{
    use HasFactory;

    protected $table = 'content_how_it_works';

    protected $fillable = [
        'content',
        'version',
        'is_published',
        'created_by',
        'url',
    ];

    protected $casts = [
        'content' => 'array',
        'is_published' => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('version', 'desc');
    }
}
