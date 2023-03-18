<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{


    public function index()
    {
        $user = Auth::guard('customer')->user();
        $customer = Customer::query()->findOrFail($user->id);
        $latestOrder=$customer->orders()->orderBy('id','DESC')->limit(5)->get();
        return view('booking.panel.main', compact('user','latestOrder'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update([
            'email'         => $request->email,
            'phone'         => $request->phone,
            'mobile_number' => $request->mobile_number,
            'department'    => $request->department,
            'image'         => $request->image,
        ]);

        return redirect()->back()->with('success', 'پروفایل شما با موفقعیت ویراش شد');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function orders(Request $request)
    {
        return view('booking.panel.orders');
    }

    public function getData(Request $request)
    {

        $user = Auth::guard('customer')->user();
        $customer = Customer::query()->findOrFail($user->id);
        if ($request->type == 'profile') {
            $latestOrder=$customer->orders()->orderBy('id','DESC')->limit(5)->get();
            return response()->json([
                'html' => view('booking.panel.profile', compact('user','latestOrder'))->render()
            ]);
        } elseif ($request->type == 'orders') {
            $orders=$customer->orders()->orderBy('id','DESC')->get();
            return response()->json([
                'html' => view('booking.panel.orders',compact('orders'))->render()
            ]);
        } elseif ($request->type == 'favorite') {
            return response()->json([
                'html' => view('booking.panel.favorites',)->render()
            ]);
        }

    }

//    public function login(Request $request)
//    {
//        return view('booking.panel.favorites');
//    }
//
//    public function authenticate(Request $request)
//    {
//        if (Auth::attempt(['email' => $request->personal_id, 'password' => $request->password])) {
//            return redirect()->intended('dashboard');
//        }
//    }
}
