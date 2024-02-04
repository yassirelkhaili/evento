<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advert extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'advert';
    protected $fillable = ["title", "content", "partnerID"];

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partnerID');
    }
}
