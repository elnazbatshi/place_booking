<tr id="social_{{@$info->id}}">

    <td>{{@$info->id}}</td>
    <td>{{@$info->email}}</td>
    <td>{{@$info->phoneNumber}}</td>
    <td>{{@$info->address}}</td>
    <td>{!!excerpt(@$info->description,20)  !!}</td>
    <td><img style="height: 100px;border-radius: 5px" src="{{@$info->image}}" alt=""></td>

    {{--    <td class="text-right text-nowrap">--}}
    {{--            <button type="button" class="btn btn-danger" data-toggle="tooltip"--}}
    {{--                    data-action="{{route('admin.deleteSocial',$social->id)}}"--}}
    {{--                    onclick="deleteSocial(this)">--}}
    {{--                <i class="fa fa-trash"></i>--}}
    {{--            </button>--}}

    {{--    </td>--}}
</tr>

