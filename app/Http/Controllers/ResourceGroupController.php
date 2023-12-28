<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\ResourceGroup;
use Illuminate\Http\Request;

class ResourceGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $resourceGroups = ResourceGroup::withCount('resourceGroupItems')->orderBy('id', 'desc')->get();
        return view('resource-groups.index', compact('resourceGroups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resource-groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $student = new ResourceGroup();
        $student->name = $request->name;
        $student->description = $request->description;
        $student->save();

        return redirect()->route('resource-groups.index')
            ->with('success', __('trans.Successfully recorded'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $resourceGroup = ResourceGroup::with('resourceGroupItems.resource')->findOrFail($id);
        $groupResourceIds = $resourceGroup->resourceGroupItems->pluck('resource_id')->unique();
        $resources = Resource::whereNotIn('id', $groupResourceIds)->orderBy('id', 'desc')->get();
        return view('resource-groups.show', compact('resourceGroup', 'resources'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ResourceGroup $resourceGroup)
    {
        return view('resource-groups.edit', compact('resourceGroup'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $student = ResourceGroup::findOrFail($id);
        $student->name = $request->name;
        $student->description = $request->description;
        $student->save();

        return redirect()->route('resource-groups.index')
            ->with('success', __('trans.Successfully updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $resourceGroup = ResourceGroup::findOrFail($id);
        $resourceGroup->delete();

        return redirect()->route('resource-groups.index')
            ->with('success', __('trans.Successfully deleted'));
    }
}
