<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Subtopic;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'order'
    ];

    public function subtopics()
    {
        return $this->hasMany(Subtopic::class)->orderBy('order');
    }
}
