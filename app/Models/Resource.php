<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    public function resourceGroupItems()
    {
        return $this->hasMany(ResourceGroupItem::class, 'resource_id');
    }

    // Resource -> ResourceGroup (Many to Many through ResourceGroupItem)
    public function resourceGroups()
    {
        return $this->belongsToMany(ResourceGroup::class, 'resource_group_items', 'resource_id', 'group_id');
    }
}
