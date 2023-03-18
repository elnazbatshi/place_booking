
@foreach($orders as $order)
    @if($status == 'all')
        <tr id="">
            <th scope="row">{{$order->id}}</th>
            <td>{{$order->location->name}}</td>
            <td>{{$order->customer->name}}</td>
            <td>{{$order->day_fa}}</td>
            <td>{{$order->startTime}}</td>
            <td>{{$order->endTime}}</td>
            <td>{{$order->id}}</td>
            <td>
                <select
                    onchange="changeStatusPost(this)"
                    data-action="{{route('order.changeStatus',$order->id)}}"
                    name="status" data-toggle="tooltip" data-placement="top"

                    class="form-select statusPost">
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_ACTIVE) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_ACTIVE}}">
                        فعال
                    </option>
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_PENDING) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_PENDING}}">
                        در حال بررسی
                    </option>
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_DEACTIVATE) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_DEACTIVATE}}">
                        غیر فعال
                    </option>
                </select>
            </td>
            <td class="text-right text-nowrap">
                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                        data-action="{{route('contactUs.show',$order->id)}}"
                        data-name="{{$order->customer->name}}"
                        data-phone-number="{{$order->customer->mobile_number}}"
                        data-email="{{$order->customer->email}}"
                        data-subject="{{$order->subject}}"
                        data-message="{{$order->desc}}"
                        data-status="{{$order->status}}"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessageModal"
                        onclick="showMessage(this)">
                    <i class="fa fa-eye"></i>
                </button>
                <button type="button" class="btn btn-danger" data-toggle="tooltip"
                        data-action="{{route('contactUs.destroy',$order->id)}}"
                        onclick="deleteMessage(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessage">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </button>
            </td>
        </tr>
    @elseif($status == 'active' && $order->status ==\App\Models\Order::STATUS_ACTIVE)
        <tr id="">
            <th scope="row">{{$order->id}}</th>
            <td>{{$order->location->name}}</td>
            <td>{{$order->customer->name}}</td>
            <td>{{$order->day_fa}}</td>
            <td>{{$order->startTime}}</td>
            <td>{{$order->endTime}}</td>
            <td>{{$order->id}}</td>
            <td>
                <select
                    onchange="changeStatusPost(this)"
                    data-action="{{route('order.changeStatus',$order->id)}}"
                    name="status" data-toggle="tooltip" data-placement="top"

                    class="form-select statusPost">
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_ACTIVE) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_ACTIVE}}">
                        فعال
                    </option>
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_PENDING) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_PENDING}}">
                        در حال بررسی
                    </option>
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_DEACTIVATE) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_DEACTIVATE}}">
                        غیر فعال
                    </option>
                </select>
            </td>
            <td class="text-right text-nowrap">
                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                        data-action="{{route('contactUs.show',$order->id)}}"
                        data-name="{{$order->customer->name}}"
                        data-phone-number="{{$order->customer->mobile_number}}"
                        data-email="{{$order->customer->email}}"
                        data-subject="{{$order->subject}}"
                        data-message="{{$order->desc}}"
                        data-status="{{$order->status}}"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessageModal"
                        onclick="showMessage(this)">
                    <i class="fa fa-eye"></i>
                </button>
                <button type="button" class="btn btn-danger" data-toggle="tooltip"
                        data-action="{{route('contactUs.destroy',$order->id)}}"
                        onclick="deleteMessage(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessage">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </button>

            </td>
        </tr>
    @elseif($status == 'pending' && $order->status ==\App\Models\Order::STATUS_PENDING)
        <tr id="">
            <th scope="row">{{$order->id}}</th>
            <td>{{$order->location->name}}</td>
            <td>{{$order->customer->name}}</td>
            <td>{{$order->day_fa}}</td>
            <td>{{$order->startTime}}</td>
            <td>{{$order->endTime}}</td>
            <td>{{$order->id}}</td>
            <td>
                <select
                    onchange="changeStatusPost(this)"
                    data-action="{{route('order.changeStatus',$order->id)}}"
                    name="status" data-toggle="tooltip" data-placement="top"

                    class="form-select statusPost">
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_ACTIVE) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_ACTIVE}}">
                        فعال
                    </option>
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_PENDING) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_PENDING}}">
                        در حال بررسی
                    </option>
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_DEACTIVATE) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_DEACTIVATE}}">
                        غیر فعال
                    </option>
                </select>
            </td>
            <td class="text-right text-nowrap">
                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                        data-action="{{route('contactUs.show',$order->id)}}"
                        data-name="{{$order->customer->name}}"
                        data-phone-number="{{$order->customer->mobile_number}}"
                        data-email="{{$order->customer->email}}"
                        data-subject="{{$order->subject}}"
                        data-message="{{$order->desc}}"
                        data-status="{{$order->status}}"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessageModal"
                        onclick="showMessage(this)">
                    <i class="fa fa-eye"></i>
                </button>
                <button type="button" class="btn btn-danger" data-toggle="tooltip"
                        data-action="{{route('contactUs.destroy',$order->id)}}"
                        onclick="deleteMessage(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <button type="button" class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessage">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </button>


            </td>
        </tr>
    @elseif($status == 'deactivate' && $order->status ==\App\Models\Order::STATUS_DEACTIVATE)
        <tr id="">
            <th scope="row">{{$order->id}}</th>
            <td>{{$order->location->name}}</td>
            <td>{{$order->customer->name}}</td>
            <td>{{$order->day_fa}}</td>
            <td>{{$order->startTime}}</td>
            <td>{{$order->endTime}}</td>
            <td>{{$order->id}}</td>
            <td>
                <select
                    onchange="changeStatusPost(this)"
                    data-action="{{route('order.changeStatus',$order->id)}}"
                    name="status" data-toggle="tooltip" data-placement="top"

                    class="form-select statusPost">
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_ACTIVE) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_ACTIVE}}">
                        فعال
                    </option>
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_PENDING) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_PENDING}}">
                        در حال بررسی
                    </option>
                    <option
                        {{($order->status ==\App\Models\Order::STATUS_DEACTIVATE) ?'selected=selected':" "}}  value="{{\App\Models\Order::STATUS_DEACTIVATE}}">
                        غیر فعال
                    </option>
                </select>
            </td>
            <td class="text-right text-nowrap">
                <button type="button" class="btn btn-primary" data-toggle="tooltip"
                        data-action="{{route('contactUs.show',$order->id)}}"
                        data-name="{{$order->customer->name}}"
                        data-phone-number="{{$order->customer->mobile_number}}"
                        data-email="{{$order->customer->email}}"
                        data-subject="{{$order->subject}}"
                        data-message="{{$order->desc}}"
                        data-status="{{$order->status}}"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessageModal"
                        onclick="showMessage(this)">
                    <i class="fa fa-eye"></i>
                </button>
                <button type="button" class="btn btn-danger" data-toggle="tooltip"
                        data-action="{{route('contactUs.destroy',$order->id)}}"
                        onclick="deleteMessage(this)">
                    <i class="fa fa-trash"></i>
                </button>

                <button type="button" class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#showMessage">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                </button>


            </td>
        </tr>
    @endif
@endforeach



