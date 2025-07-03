<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CheckIn extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'description', 'lat', 'lng', 'notes'
    ];

    public function getFormattedDateAttribute()
    {
        return $this->created_at?->format('M j, Y g:i A');
    }
}
