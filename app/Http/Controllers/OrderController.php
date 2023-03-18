<?php

namespace App\Http\Controllers;

use App\Models\LocationInfo;
use App\Models\Order;
use App\Models\Post;
use Hekmatinasser\Verta\Facades\Verta;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use MessageWay\MessageWayLaravel\Facades\MessageWayLaravel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        if(count($request->all()) >0){
            $query = Order::query();
//        $request->status && $query->where('status','like','%'.$request->status.'%');
            if ($request->dateFrom) {
                $dateFromJalali = convertPersianNumbersToEnglish($request->dateFrom);

                $query->whereDate('day', '>=', \Hekmatinasser\Verta\Verta::parseFormat('Y/m/d',$dateFromJalali)->datetime());
            }
            if ($request->dateTo) {
                $dateFromJalali = convertPersianNumbersToEnglish($request->dateTo);
                $query->whereDate('day', '<=', \Hekmatinasser\Verta\Verta::parseFormat('Y/m/d',$dateFromJalali)->datetime());
            }
            $request->trackCode && $query->where('id', $request->trackCode);
            $request->loc && $query->where('location_id', $request->loc);
            $request->client && $query->where('user_id', $request->client);
            $orders = $query->with(['customer','location'])->get();
        }else{
            $orders = Order::all();
        }
        $locations = LocationInfo::all();
        return view('admin.manage.orders.index', [
            'orders'            => $orders,
            'locations'         => $locations,
            'request'         => $request,
        ]);
    }


    public function getOrders(Request $request)
    {

        $query = Order::query();
//        $request->status && $query->where('status','like','%'.$request->status.'%');
        if ($request->dateFrom) {
            $dateFromJalali = convertPersianNumbersToEnglish($request->dateFrom);

            $query->whereDate('start', '>=', \Hekmatinasser\Verta\Verta::parseFormat('Y/m/d',$dateFromJalali)->datetime());
        }
        if ($request->dateTo) {
            $dateFromJalali = convertPersianNumbersToEnglish($request->dateTo);
            $query->whereDate('end', '<=', \Hekmatinasser\Verta\Verta::parseFormat('Y/m/d',$dateFromJalali)->datetime());
        }
        $request->id && $query->where('id', $request->id);
        $request->customerId && $query->where('customer_id', $request->customerId);
        $invoices = $query->with(['customer','orders.product'])->paginate();
//        dd($invoices);
        return response($invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function changeStatus(Request $request, $id)
    {

        $post = Order::with('Customer')->findOrFail($id);
        $post->status = $request->status;
        if($post->status == Order::STATUS_ACTIVE){
            $this->Send_Message($post['customer']['mobile_number'],'0');
        }
        $post->save();
        return response(['status' => (bool)$post, 'statusValue' => $request->status, 'message' => 'تغییر وضعیت ' . $id . 'انجام شد ']);

    }
    public function Send_Message($mobile,$themplateId){
        $message = MessageWayLaravel::sendViaSMS($mobile, $themplateId);
    }
}
