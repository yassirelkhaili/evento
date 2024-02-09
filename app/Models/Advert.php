<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Advert extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'advert';
    protected $fillable = ["title", "content", "partnerID"];

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partnerID');
    }

    public function skills () {
        return $this->belongsToMany(Skill::class,'advert_learner_skill','advert_id');
    }

    public function applcation () {
        return $this->belongsTo(Application::class,'advert_id');
    }
}
