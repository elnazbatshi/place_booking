@if($items_list)
    @foreach($items_list as $menuItem)

        @include('admin.manage.menu.ajax.item-list')

    @endforeach
@endif
