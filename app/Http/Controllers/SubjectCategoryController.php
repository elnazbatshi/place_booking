<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubjectCategory;
use App\Models\TypeCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $typeCat = TypeCategory::with('categories')->where('type', 'book')->get();

        $subject = SubjectCategory::all();
        return view('admin.manage.subject.index', compact('subject', 'typeCat'));
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

        $request->validate([
            'title'      => 'required',
            'book_id'    => 'required',
            'tag'        => 'nullable',
            'content'    => 'nullable',
            'imageIndex' => 'nullable',
        ]);
        $subject = SubjectCategory::create($request->all());
        return response(['status' => (bool)$subject, 'message' => 'فصل با موفقعیت اضافه شد']);

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeCategoryBook(Request $request)
    {

        $books = Category::where('type_id', $request->cat_id)->get();
        return response(['status' => (bool)$books, 'books' => $books]);
    }
}
