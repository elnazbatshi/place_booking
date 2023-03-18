<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\typeCat;
use App\Models\TypeCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->authorize('view', TypeCategory::class);
        $typeCat = TypeCategory::all();
        return view('admin.manage.typeCategory.index', compact('typeCat'));
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
        $this->authorize('create', TypeCategory::class);
        $validation = $request->validate([
            'name'  => ['required'],
            'type'  => ['nullable'],
            'image' => ['nullable'],
            'desc'  => ['nullable'],
        ]);

        $TypeCategory = TypeCategory::create([
            'name'  => $request->name,
            'type'  => $request->type,
            'desc'  => $request->desc,
            'image' => $request->image,
        ]);

        return response(['status' => (bool)$TypeCategory, 'message' => ' با موفقیت اضافه شد']);
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

        $this->authorize('update', TypeCategory::class);
        $validation = $request->validate([
            'name'  => ['required'],
            'type'  => ['nullable'],
            'image' => ['nullable'],
            'desc'  => ['nullable'],
        ]);
        $TypeCategory = TypeCategory::findOrFail($id);
        $TypeCategory->update([
            'name'  => $request->name,
            'type'  => $request->type,
            'image' => $request->image,
            'desc'  => $request->desc,
        ]);

        return response(['status' => (bool)$TypeCategory, 'message' => ' با موفقیت اضافه شد']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', TypeCategory::class);
        $status = TypeCategory::destroy($id);
        return response(['status' => $status]);
    }
}
