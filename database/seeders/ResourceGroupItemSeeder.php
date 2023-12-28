<?php

namespace Database\Seeders;

use App\Models\ResourceGroupItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResourceGroupItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i <= 30; $i++) {
            do {
                $groupId = rand(1, 4);
                $resourceId = rand(1, 20);
                $exists = ResourceGroupItem::where('group_id', $groupId)
                    ->where('resource_id', $resourceId)
                    ->exists();
            } while ($exists);
            ResourceGroupItem::create([
                'group_id' => $groupId,
                'resource_id' => $resourceId
            ]);
        }
    }
}
