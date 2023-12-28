<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    // Exam -> Student (Many to One)
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Exam -> ResourceGroupItem (Many to One)
    public function resourceGroupItem()
    {
        return $this->belongsTo(ResourceGroupItem::class, 'group_item_id');
    }

    // Exam -> ResourceGroup (Many to One through ResourceGroupItem)
    public function resourceGroup()
    {
        // resourceGroupItem ilişkisini kullanarak ResourceGroup'a ulaş
        return $this->resourceGroupItem->resourceGroup();
    }

    public function resourceGroupDirect()
    {
        return $this->belongsTo(ResourceGroup::class, 'group_id');
    }
}
