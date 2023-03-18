<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\LocationInfo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $posts = LocationInfo::with('categories')->get();

        return view('admin.manage.location.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::query()->where('type_id', 9)->get();

        return view('admin.manage.location.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {


        $request->validate([
            'name'       => ['nullable'],
            'desc'       => ['nullable'],
            'image'      => ['nullable'],
            'gallery'      => ['nullable'],
            'index'      => ['nullable'],
            'categories' => ['nullable'],
            'files'      => ['nullable'],
            'phone'      => ['nullable'],
            'address'    => ['nullable'],
            'status'     => ['nullable'],
            'tags'        => ['nullable'],
        ]);

        $loc = LocationInfo::query()->create([
            'name'    => $request->name,
            'index'   => $request->index,
            'phone'   => $request->phone,
            'address' => $request->address,
            'desc'    => $request->desc,
            'cat_id'  => $request->cat_id,
            'tags'  => $request->tags,
            'gallery'  => $request->gallery,
            'video'   => array_filter(explode(',', $request->video)),
            'files'   => array_filter(explode(',', $request->get('files'))),
            'image'   => array_filter(explode(',', $request->image)),
        ]);


//            $loc->categories()->attach($request->categories);
//            if ($request->get('files')) {
//                $files = collect(array_map(function ($item) {
//                    return File::query()->create([
//                        'url' => $item,
//                    ]);
//                }, explode(',', $request->get('files'))));
//                $post->files()->withTimestamps()->sync($files->pluck('id')->toArray());
//            }
        session()->flash('post_flash', 'پست جدید با موفقیت اضافه شد');
        return response(['status' => (bool)$loc, 'message' => ' با موفقیت اضافه شد']);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $location = LocationInfo::where('id', $id)->first();
        return response(['status' => (bool)$location, 'location' => $location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $categories = Category::query()->where('type_id', 9)->get();
        $post = LocationInfo::where('id', $id)->first();

        return view('admin.manage.location.create', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name'       => ['nullable'],
            'desc'       => ['nullable'],
            'image'      => ['nullable'],
            'index'      => ['nullable'],
            'categories' => ['nullable'],
            'files'      => ['nullable'],
            'phone'      => ['nullable'],
            'address'    => ['nullable'],
            'tags'    => ['nullable'],
            'status'     => ['nullable'],
        ]);
        $loc = LocationInfo::findOrFail($id);

        $loc->update([
            'name'    => $request->name,
            'index'   => $request->index,
            'phone'   => $request->phone,
            'address' => $request->address,
            'desc'    => $request->desc,
            'tags'    => $request->tags,
            'cat_id'  => $request->cat_id,
            'video'   => array_filter(explode(',', $request->video)),
            'files'   => array_filter(explode(',', $request->get('files'))),
            'image'   => array_filter(explode(',', $request->image)),
        ]);


        session()->flash('post_flash', 'پست جدید با موفقیت ویرایش شد');
        return response(['status' => (bool)$loc, 'message' => ' با موفقیت اضافه شد']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $location = LocationInfo::with(['categories'])->find($id);
        $location->delete();
        return response(['status' => $location]);
    }

    public function changeStatus(Request $request, $id)
    {

        $loc = LocationInfo::find($id);


        $loc->status = $request->input('status');
        $loc->save();
        return response(['status' => (bool)$loc, 'statusValue' => $request->input('status'), 'message' => 'تغییر وضعیت با موفقعیت انجام شد']);
    }
}
