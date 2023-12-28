<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = ['student_id', 'group_id', 'group_item_id', 'image_url'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
