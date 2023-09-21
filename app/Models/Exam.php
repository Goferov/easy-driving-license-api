<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exam';
    protected $primaryKey = 'exam_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'category_id',
        'all_points',
    ];
    public function answers() {
        return $this->hasMany(Answer::class);
    }
}
