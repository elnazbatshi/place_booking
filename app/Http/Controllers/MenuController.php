<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        $this->authorize('view', Menu::class);
        $menus = Menu::all();

        return view('admin.manage.menu.index', compact('menus'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Menu::class);
        $request->validate([
            'description' => 'nullable',
            'name'        => 'required|string|max:255|unique:roles,name',
            'image'       => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        //$extension = $request->file('image')->getClientOriginalExtension();
        //$filename = uniqid() . time() . "." . $extension;
        //Storage::disk('public')->putFileAS('logos', $request->image, $filename);
        $fileName = time() . '_' . request('image')->getClientOriginalName();
        request('image')->move(public_path('uploads/logos'), $fileName);
        $filePath = 'uploads/logos/' . $fileName;
        $menu = Menu::create([
            'description' => $request->description,
            'name'        => $request->name,
            'logo_image'  => $filePath,

        ]);


        return response(['status' => (bool)$menu]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Menu::class);
        $validated = $request->validate([
            'name'        => 'required|string',
            'description' => 'nullable|max:700',
            'logo_image'  => 'sometimes|nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $menu = Menu::query()->findOrFail($id);
//        $logo_image = $menu->logo_image;

        if ($request->logo_image) {

            if (\Illuminate\Support\Facades\File::exists($menu->logo_image)) {
                \Illuminate\Support\Facades\File::delete($menu->logo_image);
            }
            $fileName = time() . '_' . request('logo_image')->getClientOriginalName();
            request('logo_image')->move(public_path('uploads/logos'), $fileName);
            $filePath = 'uploads/logos/' . $fileName;
            $menu->update([
                'logo_image' => $filePath,
            ]);
        }
        $menu->update([
            'description' => $request->description,
            'name'        => $request->name,

        ]);
        return response(['status' => (bool)$menu, 'message' => 'بروز رسانی آیتم ' . $id . 'انجام شد ']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', Menu::class);
        $status = Menu::destroy($id);
        return response(['status' => $status]);
    }

    public function indexItem()
    {

        $this->authorize('view', MenuItem::class);

        $menu = Menu::with(['parents', 'MenuItem' => function ($q) {
            $q->whereNull('parent_id');
        }])->get();

        return view('admin.manage.menu.show', compact('menu'));
    }

    public function addItem(Request $request, $id)
    {

        $this->authorize('create', MenuItem::class);
        $request->validate([
            'group-' . $id                  => ['required', 'array'],
            'group-' . $id . '.*'           => ['required', 'array:menuName,linkMenu,indexMenu,parent_id,icon'],
            'group-' . $id . '.*.menuName'  => ['nullable', 'string'],
            'group-' . $id . '.*.linkMenu'  => ['nullable', 'string'],
            'group-' . $id . '.*.indexMenu' => ['nullable', 'numeric', 'min:0'],
            'group-' . $id . '.*.parent_id' => ['nullable', Rule::exists(MenuItem::class, 'id')],
        ]);

        try {
            return DB::transaction(function () use ($request, $id) {
                $items = [];
                foreach ($request->get('group-' . $id) as $item) {

                    $items[] = MenuItem::query()->create([
                        'menu_id'   => $id,
                        'index'     => $item['indexMenu'],
                        'title'     => $item['menuName'],
                        'parent_id' => $item['parent_id'],
                        'link'      => $item['linkMenu'],
                        'icon'      => $item['icon'],
                    ]);
                }
                $menu = Menu::with('parents')->where('id', $id)->firstOrFail();
                return response([
                    'views'   => view('admin.manage.menu.ajax.items-list', ['item' => $menu, 'items_list' => MenuItem::query()->where('menu_id', $id)->whereNull('parent_id')->get()])->render(),
                    'items'   => $items,
                    'menu'    => $menu,
                    'message' => "ایتم با موفقیت ثبت شد",
                    'status'  => true,
                ]);
            });
        } catch (Throwable $e) {
            return response([
                'error'   => $e->getMessage(),
                'message' => "خطا در ثبت اطلاعات",
                'status'  => false,
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function deleteItem(Request $request, $id)
    {
        $this->authorize('delete', MenuItem::class);
        $status = MenuItem::destroy($id);
        return response(['status' => $status]);
    }

    public function updateItem(Request $request, $id)
    {
        $this->authorize('update', MenuItem::class);
        $validated = $request->validate([
            'title'     => 'required|string',
            'link'      => 'required|string',
            'index'     => 'required|numeric',
            'parent_id' => 'nullable',
            'icon'      => 'nullable',
            'status'    => 'required',
        ]);

        $menuItem = MenuItem::where('id', $id)->update($validated);

        return response(['status' => (bool)$menuItem, 'message' => 'بروز رسانی آیتم ' . $id . 'انجام شد ']);
    }

    public function changeStatus(Request $request, $id)
    {
        $this->authorize('update', MenuItem::class);
        $menu = Menu::find($id);
        $statusValue = $request->input('status') == 1 ? 0 : 1;
        $menu->status = $statusValue;
        $menu->save();
        return response(['status' => (bool)$menu, 'statusValue' => $statusValue, 'message' => 'تغییر وضعیت ' . $id . 'انجام شد ']);
    }
}
