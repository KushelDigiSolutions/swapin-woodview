<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id', 'category_id'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function category()
    {
        return $this->belongsTo(SurveyCategory::class, 'category_id');
    }
}
