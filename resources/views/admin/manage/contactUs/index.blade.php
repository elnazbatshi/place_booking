@extends('admin.layouts.master')
@section('styleCss')
@endsection
@section('script')
    <script>
        function showMessage(sender) {

            $('#show-name').val($(sender).data('name'));
            $('#show-phoneNumber').val($(sender).data('phoneNumber'));
            $('#show-email').val($(sender).data('email'));
            $('#show-subject').val($(sender).data('subject'));
            $('#show-message').append($(sender).data('message'));
            console.log($(sender).data('status'))
            if ($(sender).data('status') == 'pending') {
                $('#show-status').text('بدون پاسخ');
                $('#show-status').addClass('pending');
                $('#show-status').removeClass('answered');
            } else {
                $('#show-status').text('پاشخ داده شده');
                $('#show-status').addClass('answered');
                $('#show-status').removeClass('pending');
            }
        }
    </script>
@endsection
@section('content')

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">همه ی پیام ها
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">پیام های خوانده
                            نشده
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">پیام های خوانده
                            شده
                        </button>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">شماره تماس</th>
                                    <th scope="col">ایمیل</th>
                                    <th scope="col">موضوع</th>
                                    <th scope="col">متن</th>
                                    <th scope="col">پاسخ داده شده</th>
                                    <th scope="col">عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($messages as $message)
                                    <tr id="contact_{{$message->id}}">
                                        <th scope="row">{{$message->id}}</th>
                                        <td>{{$message->name}}</td>
                                        <td>{{$message->phoneNumber}}</td>
                                        <td>{{$message->email}}</td>
                                        <td>{{$message->subject}}</td>
                                        <td>{{ excerpt($message->message,'15') }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input onchange="changeStatus(this)"
                                                       data-action="{{route('contactUs.changeStatus',$message->id)}}"
                                                       data-status="{{$message->status}}"
                                                       {{$message->status==\App\Models\ContactUs::STATUS_ANSWERED ?  "checked" : " "}}
                                                       class="form-check-input status_menu" type="checkbox"
                                                       id="mySwitch"
                                                       name="darkmode"
                                                       value="1">
                                            </div>
                                        </td>
                                        <td class="text-right text-nowrap">
                                            <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                                    data-name="{{$message->name}}"
                                                    data-phone-number="{{$message->phoneNumber}}"
                                                    data-email="{{$message->email}}"
                                                    data-subject="{{$message->subject}}"
                                                    data-message="{{$message->message}}"
                                                    data-status="{{$message->status}}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#showMessageModal"
                                                    onclick="showMessage(this)">
                                                <i class="fa fa-eye"></i>
                                            </button>

                                            <button type="button" class="btn btn-danger" data-toggle="tooltip"
                                                    data-action="{{route('contactUs.destroy',$message->id)}}"
                                                    onclick="deleteMessage(this)">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">شماره تماس</th>
                                    <th scope="col">ایمیل</th>
                                    <th scope="col">موضوع</th>
                                    <th scope="col">متن</th>
                                    <th scope="col">عملیات</th>
                                </tr>
                                </thead>
                                <tbody id="">
                                @if($message_not_answered->count()>0)
                                    @foreach($message_not_answered as $message_a)
                                        <tr id="social_{{$message_a->id}}">
                                            <th scope="row">{{$message_a->id}}</th>
                                            <td>{{$message_a->name}}</td>
                                            <td>{{$message_a->phoneNumber}}</td>
                                            <td>{{$message_a->email}}</td>
                                            <td>{{$message_a->subject}}</td>
                                            <td>{{ excerpt($message_a->message,'15') }}</td>
                                            <td class="text-right text-nowrap">
                                                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                                        data-action="{{route('contactUs.show',$message_a->id)}}"
                                                        data-name="{{$message_a->name}}"
                                                        data-phone-number="{{$message_a->phoneNumber}}"
                                                        data-email="{{$message_a->email}}"
                                                        data-subject="{{$message_a->subject}}"
                                                        data-message="{{$message_a->message}}"
                                                        data-status="{{$message_a->status}}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showMessageModal"
                                                        onclick="showMessage(this)"
                                                >
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="tooltip"
                                                        data-action="{{route('contactUs.destroy',$message_a->id)}}"
                                                        onclick="deleteMessage(this)">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="container-fluid">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">نام</th>
                                    <th scope="col">شماره تماس</th>
                                    <th scope="col">ایمیل</th>
                                    <th scope="col">موضوع</th>
                                    <th scope="col">متن</th>
                                    <th scope="col">عملیات</th>
                                </tr>
                                </thead>
                                <tbody id="">
                                @if($message_answered->count()>0)
                                    @foreach($message_answered as $message_p)
                                        <tr id="social_{{$message_p->id}}">
                                            <th scope="row">{{$message_p->id}}</th>
                                            <td>{{$message_p->name}}</td>
                                            <td>{{$message_p->phoneNumber}}</td>
                                            <td>{{$message_p->email}}</td>
                                            <td>{{$message_p->subject}}</td>
                                            <td>{{ excerpt($message_p->message,'15') }}</td>
                                            <td class="text-right text-nowrap">
                                                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                                                        data-action="{{route('contactUs.show',$message_p->id)}}"
                                                        data-name="{{$message_p->name}}"
                                                        data-phone-number="{{$message_p->phoneNumber}}"
                                                        data-email="{{$message_p->email}}"
                                                        data-subject="{{$message_p->subject}}"
                                                        data-message="{{$message_p->message}}"
                                                        data-status="{{$message_p->status}}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#showMessageModal"
                                                        onclick="showMessage(this)">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                {{--                                            <button type="button" class="btn btn-danger" data-toggle="tooltip"--}}
                                                {{--                                                    data-action="{{route('contactUs.destroy',$message_p->id)}}"--}}
                                                {{--                                                    onclick="deleteMessage(this)">--}}
                                                {{--                                                <i class="fa fa-trash"></i>--}}
                                                {{--                                            </button>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<div class="modal fade " id="showMessageModal" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">نمایش پیام </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body container ">
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">نام </label>
                    <input id="show-name" disabled type="text" class="form-control ">
                </div>
                <div class="mb-3">
                    <label for="show-phoneNumber" class="form-label">شماره همراه </label>
                    <input id="show-phoneNumber" disabled type="text" class="form-control ">
                </div>
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">ایمیل </label>
                    <input id="show-email" disabled type="text" class="form-control ">
                </div>
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">موضوع </label>
                    <input id="show-subject" disabled type="text" class="form-control ">
                </div>
                <div class="mb-3">
                    <label for="formrow-firstname-input" class="form-label">پیامک </label>

                    <div class=" message-box ">
                        <span id="show-message">
                        </span>
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-between w-50 flex-wrap">
                    <label for="formrow-firstname-input" class="form-label">وضعیت </label>
                    <div>
                        <span id="show-status">
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
