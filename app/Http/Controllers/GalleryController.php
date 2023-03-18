<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::get();
        return view('admin.manage.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.manage.gallery.create');
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
            'title'   => ['required'],
            'img_src' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $gallery = Gallery::create([
                'title'   => $request->title,
                'img_src' => $request->img_src,
            ]);
            DB::commit();
            session()->flash('post_flash', 'اسلایدر جدید با موفقیت اضافه شد');
            return response(['status' => (bool)$gallery, 'message' => ' با موفقیت اضافه شد']);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            return response(['status' => false, 'message' => 'خطایی وجود دارد']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $galleries = Gallery::where('id', $id)->first();

        return view('admin.manage.gallery.create', compact('galleries'));
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
            'title'   => ['required'],
            'img_src' => ['required'],
        ]);
        $Gallery = Gallery::findOrFail($id);
        $Gallery->update([
            'title'   => $request->title,
            'img_src' => $request->img_src,
        ]);

        session()->flash('post_flash', 'گالری  با موفقیت ویرایش شد');
        return response(['status' => (bool)$Gallery, 'message' => ' گالری  با موفقیت ویرایش شد']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $Gallery = Gallery::find($id);
        $Gallery->delete();
        return response(['status' => $Gallery]);
    }
}
