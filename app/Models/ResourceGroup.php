<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceGroup extends Model
{
    use HasFactory;

    public function resourceGroupItems()
    {
        return $this->hasMany(ResourceGroupItem::class, 'group_id');
    }

    // ResourceGroup -> Resource (Many to Many through ResourceGroupItem)
    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'resource_group_items', 'group_id', 'resource_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'group_id');
    }
}
