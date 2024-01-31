<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasFactory;
    protected $table = 'advert';
    protected $fillable = ["title", "content", "partnerID"];

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partnerID');
    }
}
