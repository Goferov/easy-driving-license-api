<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answer';
    protected $primaryKey = 'answer_id';
    public $timestamps = false;

    protected $fillable = [
        'exam_id',
        'question_id',
        'answer',
        'is_correct',
    ];

    use HasFactory;
}
