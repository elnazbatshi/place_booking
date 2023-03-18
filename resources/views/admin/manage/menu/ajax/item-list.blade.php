{{--@foreach($item->parents as $parent)--}}
{{--    @if($parent->parent_id==Null)--}}
{{--        <option value="{{ $parent->id }}" class="{{$parent->id==$menuItem->id ?' d-none  ': ''}}" @if($parent->id == $menuItem->parent_id) selected @endif>{{ $parent->title }}</option>@endif--}}
{{--    @if($parent->children)--}}
{{--        @foreach($parent->children as $children)--}}

{{--            <option value="{{ $children->id }}" class="{{$children->parent_id==$parent->id ?' d-none  ': ''}}" @if($children->id == $parent->parent_id) selected @endif>{{$parent->title .'=>'.$children->title }}</option>--}}
{{--        @endforeach--}}
{{--    @endif--}}


{{--@endforeach--}}
<div
    id="menuItem_{{$menuItem->id}}"
    class="row">
    <div
        class="mb-3 col-lg-2">
        <label
            for="name">عنوان
            ایتم
            منو</label>
        <input
            type="text"
            value="{{$menuItem->title}}"
            name="title"

            class="form-control">
    </div>

    <div
        class="mb-3 col-lg-2">
        <label
            for="link">آدرس
            منو</label>
        <input
            type="text"
            value="{{$menuItem->link}}"
            name="link"
            class="form-control">
    </div>
    <div
        class="mb-3 col-lg-1">
        <label
            for="link">ایکون
            منو</label>
        <input
            type="text"
            value="{{$menuItem->icon}}"
            name="icon"
            class="form-control">
    </div>
    <div
        class="mb-3 col-lg-1">
        <label
            for="index">ترتیب
            قرارگیری</label>
        <input
            type="number"
            value="{{$menuItem->index}}"
            name="index"
            class="form-control ">
    </div>
    <div class="mb-3 col-3 ">
        <label for="formrow-firstname-input" class="form-label">ایتم ها </label>
        <br>
        <select data-select="{{$menuItem->title}}" data-menuItem-{{$menuItem->menu_id}}="" style="width: 100%;"
                name="parent_id" class="form-control">
            <option value="">مادر</option>
            @foreach($item->parents as $parent)
                @if($parent->parent_id==Null)
                    <option value="{{ $parent->id }}" class="{{$parent->id==$menuItem->id ?' d-none  ': ''}}"
                            @if($parent->id == $menuItem->parent_id) selected @endif>{{ $parent->title }}</option>@endif
                @if($parent->children)
                    @foreach($parent->children as $children)

                        <option value="{{ $children->id }}"
                                class="{{$parent->id==$menuItem->parent_id ?' d-none  ': ''}}"
                                @if($children->id == $menuItem->parent_id) selected @endif>{{$parent->title .'=>'.$children->title }}</option>
                    @endforeach
                @endif


            @endforeach
        </select>
    </div>

    <div
        class="col-lg-2 align-self-center">
        <div class="d-flex gap-3 ">
            @can('update',\App\Models\MenuItem::class)
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="mySwitch"
                           {{$menuItem->status==1 ?  "checked" : " "}}         name="darkmode" value="1">
                </div>
            @endcan
            @can('delete',\App\Models\MenuItem::class)
                <button
                    onclick="deleteItemMenu(this)"
                    data-action="{{route('menu.deleteItem',$menuItem->id)}}"
                    type="button"
                    data-toggle="tooltip"
                    class="btn btn-danger"
                    title="پاک کردن ایتم">
                    <i class="fa fa-trash"></i>
                </button>
            @endcan
            @can('update',\App\Models\MenuItem::class)
                <button
                    onclick="updateItemMenu(this,event)"
                    data-action="{{route('menu.updateItem',$menuItem->id)}}"
                    type="button"
                    data-toggle="tooltip"
                    class="btn btn-primary"
                    title="اپدیت ایتم">
                    <i class="fa fa-edit"></i>
                </button>
            @endcan

        </div>
    </div>
</div>
@if($menuItem->children->count())
    <div class="mx-4">
        @foreach($menuItem->children as $menuItem)

            @include('admin.manage.menu.ajax.item-list')

        @endforeach
    </div>
@endif

