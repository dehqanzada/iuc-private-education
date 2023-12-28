<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceGroupItem extends Model
{
    use HasFactory;

    public function resourceGroup()
    {
        return $this->belongsTo(ResourceGroup::class, 'group_id');
    }

    // ResourceGroupItem -> Resource (Many to One)
    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }
}
