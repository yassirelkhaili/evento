<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $table = "partner";
    protected $fillable = ['name', 'description', 'industry', 'size', 'location', 'logo'];
}
