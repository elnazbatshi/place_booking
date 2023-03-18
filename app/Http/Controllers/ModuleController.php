<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->authorize('view', Module::class);

        $modules = Module::with(['categories'])->get();

        return view('admin.manage.module.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', Module::class);
        $categories = Category::query()->where('type_id', 2)->get();
        return view('admin.manage.module.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Module::class);
        $request->validate([
            'name'       => ['required'],
            'content'    => ['required'],
            'img_src'    => ['required'],
            'categories' => ['required'],
        ]);


        $module = Module::query()->create($request->except(['categories']));
        $module->categories()->attach($request->categories);
        session()->flash('post_flash', 'ماژول جدید با موفقیت اضافه شد');
        return response(['status' => (bool)$module, 'message' => ' با موفقیت اضافه شد']);


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
        $this->authorize('update', Module::class);

        $categories = Category::query()->where('type_id', 2)->get();
        $module = Module::where('id', $id)->with('categories')->first();

        return view('admin.manage.module.create', compact('module', 'categories'));
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
        $this->authorize('update', Module::class);
        $request->validate([
            'name'       => ['required'],
            'content'    => ['required'],
            'img_src'    => ['required'],
            'categories' => ['required'],
        ]);

        $module = Module::findOrFail($id);
        $input = $request->except(['categories']);
        $module->update($input);
        $module->categories()->sync($request->categories);

        session()->flash('post_flash', 'پست  با موفقیت ویرایش شد');
        return response(['status' => (bool)$module, 'message' => ' پست  با موفقیت ویرایش شد']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Module::class);
        $module = Module::with('categories')->find($id);
        $module->categories()->detach();
        $module->delete();
        return response(['status' => $module]);
    }

    public function changeStatus(Request $request, $id)
    {
        $this->authorize('update', Module::class);
        $module = Module::find($id);
        $statusValue = $request->input('status') == 1 ? 0 : 1;
        $module->status = $statusValue;
        $module->save();
        return response(['status' => (bool)$module, 'statusValue' => $statusValue, 'message' => 'تغییر وضعیت با موفقعیت انجام شد']);
    }
}
