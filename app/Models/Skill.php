<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = "skill";

    protected $fillable = ["name", "created_at", "updated_at"];

    public function users()
    {
        return $this->belongsToMany(User::class, 'advert_learner_skill', 'skill_id', 'learner_id')->withTimestamps();
    }

    public function adverts()
    {
        return $this->belongsToMany(Advert::class, 'advert_learner_skill', 'skill_id', 'advert_id')->withTimestamps();
    }
}
