<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\typeCat;
use App\Models\TypeCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->authorize('view', Category::class);
        $category = Category::all();

        $typeCat = TypeCategory::all();

        return view('admin.manage.category.index', compact('category', 'typeCat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->authorize('create', Category::class);
        $request->validate([
            'title'   => 'required|string|max:255',
            'type_id' => 'required',
            'img_src' => 'nullable',
        ]);

        $category = Category::create([
            'title'   => $request->title,
            'type_id' => $request->type_id,
            'img_src' => $request->img_src
        ]);
        return response(['status' => (bool)$category, 'message' => 'دسته بندی با موفقعیت اضافه شد']);

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
        //
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
        $this->authorize('update', Category::class);
        $request->validate([
            'title'   => 'required|string|max:255',
            'type_id' => 'required',
        ]);
        $category = Category::findOrFail($id);
        $category->update([
            'title'   => $request->title,
            'type_id' => $request->type_id,
            'img_src' => $request->img_src
        ]);
        return response(['status' => (bool)$category, 'message' => 'دسته بندی با موفقعیت ویرایش شد ']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Category::class);
        $status = Category::destroy($id);
        return response(['status' => $status]);
    }
}
