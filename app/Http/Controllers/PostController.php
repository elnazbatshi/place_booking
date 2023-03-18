<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Post;
use App\Models\Scopes\PostScope;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $this->authorize('view', Post::class);

        $posts = Post::withoutGlobalScope(PostScope::class)->with(['categories', 'files'])->whereNull('categoryType')->get();

        return view('admin.manage.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->authorize('create', create::class);
        $categories = Category::query()->where('type_id', 1)->get();
        return view('admin.manage.post.create', compact('categories'));
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
            'title'       => ['required'],
            'content'     => ['required'],
            'semiContent' => ['required'],
            'imageIndex'  => ['required'],
            'tags'        => ['nullable'],
            'categories'  => ['required'],
            'files'       => ['nullable'],
            'privacy'     => ['nullable'],
            'status'      => ['nullable'],
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
            return response(['status' => (bool)$post, 'message' => ' با موفقیت اضافه شد']);
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

        $this->authorize('update', Post::class);
        $categories = Category::query()->where('type_id', 1)->get();
        $post = Post::withoutGlobalScope(PostScope::class)->where('id', $id)->with(['categories', 'files'])->first();

        return view('admin.manage.post.create', compact('post', 'categories'));
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
            'title'       => ['required'],
            'content'     => ['required'],
            'semiContent' => ['required'],
            'imageIndex'  => ['required'],
            'tags'        => ['nullable'],
            'categories'  => ['required'],
            'files'       => ['nullable'],
            'privacy'     => ['nullable'],
            'status'      => ['nullable'],
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


    public function changeStatusPost(Request $request, $id)
    {
        try {
            $post = Post::withoutGlobalScope(PostScope::class)->findOrFail($id);
            if ($request->status == 'active') {
                $post->status = Post::STATUS_ACTIVE;
            } else if ($request->status == 'deactivate') {
                $post->status = Post::STATUS_DEACTIVATE;
            } else if ($request->status == 'admin choice') {
                $post->status = Post::STATUS_CHOICE_ADMIN;
            }
            $post->save();

            return response(['status' => (bool)$post, 'statusValue' => $request->status, 'message' => 'تغییر وضعیت ' . $id . 'انجام شد ']);

        } catch (Throwable $e) {
            report($e);

            return false;
        }
    }

    public function changePrivacyPost(Request $request, $id)
    {

        $post = Post::find($id);
        $post->privacy = $request->privacy;
        $post->save();
        return response(['status' => (bool)$post, 'statusValue' => $request->privacy, 'message' => 'تغییر وضعیت ' . $id . 'انجام شد ']);
    }

    public function tags()
    {

        $allTags = Post::get()->pluck('tags')->flatten()->unique()->toArray();
        $tags = array_filter($allTags);

        $selected = Setting::where('type', 'status_keyword')->first();
        $selected_tag = $selected->value;

        return view('admin.manage.tags.index', compact('tags', 'selected_tag', 'selected'));

    }

    public function storeTags(Request $request)
    {

        $tags = Setting::where('type', 'status_keyword')->first();
        $tags->value = $request->tags;
        $tags->save();
        return response(['status' => (bool)$tags, 'message' => 'تغییر انجام شد']);
    }

    public function changeStatusKeyword(Request $request)
    {
        $newStatus = ($request->status == 'default') ? 'admin' : 'default';

        $tags = Setting::where('type', 'status_keyword')->first();
        $tags->name = $newStatus;
        $tags->save();
        return response(['status' => (bool)$tags, 'statusValue' => $newStatus, 'message' => 'تغییر وضعیت انجام شد']);
    }
}
