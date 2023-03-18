<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Scopes\PostScope;
use App\Models\TypeCategory;
use App\Models\File;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;


class MultiMorphPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $posts = Post::query()->withoutGlobalScope(PostScope::class)->where('categoryType', $request->type)->with(['categories', 'files'])->get();
        $ctype = $request->type;

        return view('admin.manage.multiMorphPost.index', compact('posts', 'ctype'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {

        $this->authorize('create', create::class);
        $typeCategories = TypeCategory::query()->with('categories')->where('id', $request->type)->first();
        $TypeCategory = $request->type;
        return view('admin.manage.multiMorphPost.create', compact('typeCategories', 'TypeCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $this->authorize('create', Post::class);
        $request->validate([
            'title'        => ['required'],
            'content'      => ['required'],
            'semiContent'  => ['required'],
            'imageIndex'   => ['required'],
            'tags'         => ['nullable'],
            'categories'   => ['required'],
            'categoryType' => ['required'],
            'audio'        => ['nullable'],
            'video'        => ['nullable'],
            'files'        => ['nullable'],
            'privacy'      => ['nullable'],
            'status'       => ['nullable'],
        ]);

        try {

            DB::beginTransaction();
            $post = Post::query()->create($request->except(['categories', 'files']));

            $post->categories()->attach($request->categories);

            if ($request->get('files')) {
                $files = collect(array_map(function ($item) {
                    return File::query()->create([
                        'url' => $item,
                    ]);
                }, explode(',', $request->get('files'))));


                $post->files()->withTimestamps()->sync($files->pluck('id')->toArray());
            }

            DB::commit();
            session()->flash('post_flash', 'پست جدید با موفقیت اضافه شد');
            return response(['status' => (bool)$post, 'message' => 'پست با موفقیت اضافه شد']);
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
    public function edit($id, Request $request)
    {
        $this->authorize('update', Post::class);
        $post = Post::where('id', $id)->with(['categories', 'files'])->first();
        $typeCategories = TypeCategory::query()->with('categories')->where('id', $request->type)->first();
        $TypeCategory = $request->type;
        return view('admin.manage.multiMorphPost.create', compact('post', 'typeCategories', 'TypeCategory'));
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
        $this->authorize('update', Post::class);
        $request->validate([
            'title'        => ['required'],
            'content'      => ['required'],
            'semiContent'  => ['required'],
            'imageIndex'   => ['required'],
            'tags'         => ['nullable'],
            'categories'   => ['required'],
            'categoryType' => ['required'],
            'audio'        => ['nullable'],
            'video'        => ['nullable'],
            'files'        => ['nullable'],
            'privacy'      => ['nullable'],
            'status'       => ['nullable'],
        ]);
        $post = Post::findOrFail($id);
        $input = $request->except(['categories', 'files']);
        $post->update($input);
        $post->categories()->sync($request->categories);
        if ($request->get('files')) {
            $files = collect(array_map(function ($item) {
                return File::query()->create([
                    'url' => $item,
                ]);
            }, explode(',', $request->get('files'))));

            $post->files()->withTimestamps()->sync($files->pluck('id')->toArray());
        }
        session()->flash('post_flash', 'پست  با موفقیت ویرایش شد');
        return response(['status' => (bool)$post, 'message' => ' پست  با موفقیت ویرایش شد']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Post::class);
        $post = Post::with(['categories', 'files'])->find($id);
        $post->categories()->detach();
        $post->files()->detach();
        $post->delete();
        return response(['status' => $post]);
    }
}
