<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "application";

    protected $fillable = [
        "learner_id",
        "advert_id",
        "status",
        "updated_at",
        "deleted_at",
        "created_at"
    ];

    public function advert()
    {
        return $this->belongsTo(Advert::class, "advert_id");
    }
}
