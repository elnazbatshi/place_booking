<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Customer::all();
        return view('admin.manage.customer.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = $request->validate([
            'name'          => ['required'],
            'email'         => ['required', 'email', 'unique:users,email'],
            'phone'         => ['required'],
            'mobile_number' => ['required'],
            'department'    => ['required'],
            'personal_id'   => ['required'],
            'password'      => ['required', 'min:6'],
        ]);

        $user = Customer::create([
            'phone'         => $request->phone,
            'mobile_number' => $request->mobile_number,
            'department'    => $request->department,
            'personal_id'   => $request->personal_id,
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);
        return response(['status' => (bool)$user, 'message' => 'کاربر با موفقیت اضافه شد']);
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

        $validation = $request->validate([
            'name'          => ['required'],
            'email'         => ['required', 'email', 'unique:users,email'],
            'phone'         => ['required'],
            'mobile_number' => ['required'],
            'department'    => ['required'],
            'personal_id'   => ['required'],
            'password'      => ['required', 'min:6'],

        ]);
        $user = Customer::findOrFail($id);
        $user->update([
            'phone'         => $request->phone,
            'mobile_number' => $request->mobile_number,
            'department'    => $request->department,
            'personal_id'   => $request->personal_id,
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        return response(['status' => (bool)$user, 'message' => 'کاربر با موفقیت اضافه شد']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Customer::destroy($id);
        return response(['status' => $status]);
    }
}
