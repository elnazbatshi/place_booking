@foreach($socials as $social)

    <tr id="social_{{$social->id}}">

        <th scope="row">{{$social->id}}</th>
        <td>{{$social->name}}</td>
        <td>{{$social->value}}</td>

        <td class="text-right text-nowrap">

            <button type="button" class="btn btn-primary mx-2"
                    onclick="editSocial(this)"
                    data-social-name="{{$social->name}}"
                    data-social-value="{{$social->value}}"
                    data-social-id="{{$social->id}}"
                    data-action="{{$social->name}}"
                    data-bs-toggle="modal"
                    data-bs-target="#editSocialModal"
                    data-toggle="tooltip">
                <i class="fa fa-edit"></i>
            </button>

            <button type="button" class="btn btn-danger" data-toggle="tooltip"
                    data-action="{{route('admin.deleteSocial',$social->id)}}"
                    onclick="deleteSocial(this)">
                <i class="fa fa-trash"></i>
            </button>

        </td>
    </tr>
@endforeach
