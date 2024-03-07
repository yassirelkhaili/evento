<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'address',
        'date',
        'available_seats',
        'capacity',
        'validation_method',
        'category_id',
        'user_id',
        'event_picture',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
