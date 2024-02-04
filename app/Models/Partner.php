<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "partner";
    protected $fillable = ['name', 'description', 'industry', 'size', 'location', 'logo'];
}
