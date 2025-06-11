<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
        'original_word',
        'canonical_form',
        'length',
    ];

    protected $casts = [
        'length' => 'integer',
    ];

    /**
     * Scope for finding anagrams of a given canonical form
     */
    public function scopeAnagramsOf($query, string $canonicalForm, string $excludeWord = null)
    {
        $query->where('canonical_form', $canonicalForm);
        
        if ($excludeWord) {
            $query->where('original_word', '!=', $excludeWord);
        }
        
        return $query;
    }
}
