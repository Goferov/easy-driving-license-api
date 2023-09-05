<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    protected $primaryKey = 'question_id';
    public $timestamps = false;

    protected $fillable = [
        'type_id',
        'number',
        'name' ,
        'block_name' ,
        'question',
        'answer_a',
        'answer_b',
        'answer_c',
        'good_answer',
        'file_src',
        'points' ,
        'source' ,
        'goal',
        'security_rel',
        'subject',
    ];

    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'question_category', 'question_id', 'category_id');
    }
}
