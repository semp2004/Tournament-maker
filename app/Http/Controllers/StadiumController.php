<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;
use Storage;

class StadiumController extends Controller
{
    public function index()
    {
        $stadiums = Stadium::get();

        return view(view: 'stadium.stadiums', data: ['stadiums' => $stadiums]);
    }

    public function stadium($id)
    {
        $stadium = Stadium::find($id);

        if (!$stadium) {
            abort(404);
        }

        return view(view: 'stadium.stadium', data: ['stadium' => $stadium]);
    }

    public function adminIndex()
    {
        $stadiums = Stadium::get();

        return view(view: 'stadium.admin.stadiums', data: ['stadiums' => $stadiums]);
    }

    public function add()
    {
        return view('stadium.admin.stadium-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png|max:2408',
        ]);

        $stadium = new Stadium();

        $stadium->name = $request->input('name');
        $stadium->location = $request->input('location');

        if ($request->file('image'))
        {
            $file = $request->file('image');
            $saved_file = Storage::put(path: "images", contents:  $file);

            $stadium->image_path = $saved_file;
        }

        $stadium->save();

        return redirect(route('admin.stadiums'));
    }

    public function edit($id)
    {
        $stadium = Stadium::find($id);

        if (!$stadium) {
            abort(404);
        }

        return view(view: 'stadium.admin.stadium-edit', data: ['stadium' => $stadium]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png|max:2408',
            'id' => 'required|int',
        ]);

        $stadium = Stadium::find($request->input('id'));

        $stadium->name = $request->input('name');
        $stadium->location = $request->input('location');

        if ($request->file('image')) {
            $file = $request->file('image');
            $saved_file = Storage::put(path: "images", contents:  $file);

            $stadium->image_path = $saved_file;
        }

        $stadium->save();

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|int'
        ]);

        $stadium = Stadium::find($request->input('id'));

        $stadium->delete();

        return redirect()->back();
    }

    public function destroyImage($id)
    {
        $stadium = Stadium::find($id);

        if (!$stadium) {
            abort(404);
        }

        if (isset($stadium->image_path)) {
            Storage::delete($stadium->image_path);

            $stadium->image_path = null;
            $stadium->save();
        }

        return redirect()->back();
    }
}
