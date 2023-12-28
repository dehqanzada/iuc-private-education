<?php

namespace App\Http\Controllers;

use App\Models\ResourceGroupItem;
use Illuminate\Http\Request;

class ResourceGroupItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('resource-group-items');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ResourceGroupItem $resourceGroupItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($resourceGroupId, Request $request)
    {
        $resourceId = $request->query('resource_id');

        $item = new ResourceGroupItem();
        $item->group_id = $resourceGroupId;
        $item->resource_id = $resourceId;
        $item->save();

        return redirect()->route('resource-groups.show', ['resource_group' => $resourceGroupId]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ResourceGroupItem $resourceGroupItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = ResourceGroupItem::findOrFail($id);
        $student->delete();
        return back()->with('success', __('trans.Successfully deleted'));
    }
}
