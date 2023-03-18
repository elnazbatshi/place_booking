<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $sliders = Slider::with(['categories'])->get();
        return view('admin.manage.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::query()->where('type_id', 3)->get();

        return view('admin.manage.slider.create', compact('categories'));
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
            'title'      => ['required'],
            'content'    => ['required'],
            'img_src'    => ['required'],
            'url'        => ['required'],
            'categories' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $slider = Slider::query()->create($request->except(['categories']));
            $slider->categories()->attach($request->categories);
            DB::commit();
            session()->flash('post_flash', 'اسلایدر جدید با موفقیت اضافه شد');
            return response(['status' => (bool)$slider, 'message' => ' با موفقیت اضافه شد']);
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
        $categories = Category::query()->where('type_id', 3)->get();
        $slider = Slider::where('id', $id)->with('categories')->first();
        return view('admin.manage.slider.create', compact('slider', 'categories'));
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
            'title'      => ['required'],
            'content'    => ['required'],
            'img_src'    => ['required'],
            'categories' => ['required'],
            'url'        => ['required'],
        ]);
        $slider = Slider::findOrFail($id);
        $input = $request->except(['categories']);
        $slider->update($input);
        $slider->categories()->sync($request->categories);
        if ($request->get('files')) {
            $files = collect(array_map(function ($item) {
                return File::query()->create([
                    'url' => $item,
                ]);
            }, explode(',', $request->get('files'))));

            $slider->files()->withTimestamps()->sync($files->pluck('id')->toArray());
        }
        session()->flash('post_flash', 'اسلایدر  با موفقیت ویرایش شد');
        return response(['status' => (bool)$slider, 'message' => ' اسلایدر  با موفقیت ویرایش شد']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $slider = Slider::with(['categories'])->find($id);
        $slider->categories()->detach();
        $slider->delete();
        return response(['status' => $slider]);
    }
}
