<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session('teacherSession')) {
            return redirect()->route('home')->with('error', 'yetkiniz bulunmamaktadir');
        }
        $resources = Resource::orderBy('id', 'desc')->get();
        return view('resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.create');

    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
//        $resource = new Resource;
//
//        if($request->form_type === 'right'){
//            if ($request->hasFile('image')) {
//                $imagePath = $request->file('image')->store('public/images');
//                $resource->image_url = $imagePath;
//            }
//            if ($request->hasFile('right_music')) {
//                $musicPath = $request->file('right_music')->store('public/musics');
//                $resource->music_url = $musicPath;
//            }
//            $resource->name = null;
//            $resource->auto_voiceover = false;
//            $resource->form_type = 'right';
//        }else{
//            $resource->name = $request->input('name');
//            $resource->auto_voiceover = $request->has('auto_voiceover');
//            if ($request->hasFile('left_music')) {
//                $musicPath = $request->file('left_music')->store('public/musics');
//                $resource->music_url = $musicPath;
//            }
//            $resource->image_url = null;
//            $resource->form_type = 'left';
//        }
//        $resource->save();
//        return redirect()->route('resources.index')
//            ->with('success', 'Successfully recorded.');
//    }

    public function store(Request $request)
    {
        $resource = new Resource;

        if ($request->form_type === 'right') {
            if ($request->hasFile('image')) {
                $fileName = $request->file('image')->hashName();
                $imagePath = Storage::disk('public')
                    ->putFileAs('images', $request->file('image'), $fileName);
                $resource->image_url = $fileName;
            }
            if ($request->hasFile('right_music')) {
                $fileName = $request->file('right_music')->hashName();
                $musicPath = Storage::disk('public')
                    ->putFileAs('musics', $request->file('right_music'), $fileName);
                $resource->music_url = $fileName;
            }
            $resource->name = null;
            $resource->auto_voiceover = false;
            $resource->form_type = 'right';
        } else {
            $resource->name = $request->input('name');
            $resource->auto_voiceover = $request->has('auto_voiceover');
            if(!$request->has('auto_voiceover')){
                if ($request->hasFile('left_music')) {
                    $fileName = $request->file('left_music')->hashName();
                    $musicPath = Storage::disk('public')->putFileAs('musics', $request->file('left_music'), $fileName);
                    $resource->music_url = $fileName;
                }
            }else{
                $resource->music_url = null;
            }

            $resource->image_url = null;
            $resource->form_type = 'left';
        }

        $resource->save();

        return redirect()->route('resources.index')
            ->with('success', __('trans.Successfully recorded'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        return view('resources.show', compact('resource'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        return view('resources.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $resource = Resource::findOrFail($id);

        if($request->input('form_type') === 'left') {
            // Sol form işlemleri
            $resource->name = $request->input('name');
            $resource->auto_voiceover = $request->has('auto_voiceover');

            if(!$request->has('auto_voiceover')){
                if ($request->hasFile('left_music')) {
                    $fileName = $request->file('left_music')->hashName();
                    $musicPath = Storage::disk('public')->putFileAs('musics', $request->file('left_music'), $fileName);
                    $resource->music_url = $fileName;
                }
            }else{
                $resource->music_url = null;
            }

            $resource->image_url = null;
        } else {

            if ($request->hasFile('image')) {
                $fileName = $request->file('image')->hashName();
                $imagePath = Storage::disk('public')->putFileAs('images', $request->file('image'), $fileName);
                $resource->image_url = $fileName;
            }

            if ($request->hasFile('right_music')) {
                $fileName = $request->file('right_music')->hashName();
                $musicPath = Storage::disk('public')->putFileAs('musics', $request->file('right_music'), $fileName);
                $resource->music_url = $fileName;
            }

            $resource->name = null;
            $resource->auto_voiceover = false;
        }

        $resource->save();

        return redirect()->route('resources.index')
            ->with('success', __('trans.Resource updated successfully'));
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resource = Resource::findOrFail($id);
        $resource->delete();

        return redirect()->route('resources.index')
            ->with('success', __('trans.Successfully deleted'));
    }
}
