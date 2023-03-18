<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = 'ارتباط یا ما';
        $messages = ContactUs::all();
        $message_answered = ContactUs::where('status', ContactUs::STATUS_ANSWERED)->get();
        $message_not_answered = ContactUs::where('status', ContactUs::STATUS_PENDING)->get();

        return view('admin.manage.contactUs.index', compact('title', 'messages', 'message_answered', 'message_not_answered'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

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
        $status = ContactUs::destroy($id);
        return response(['status' => $status]);
    }

    public function changeStatus(Request $request, $id)
    {
        $Message = ContactUs::find($id);
        $statusValue = $request->input('status') == ContactUs::STATUS_ANSWERED ? ContactUs::STATUS_PENDING : ContactUs::STATUS_ANSWERED;
        $Message->status = $statusValue;
        $Message->save();
        return response(['status' => (bool)$Message, 'statusValue' => $statusValue, 'message' => 'تغییر وضعیت ' . $id . 'انجام شد ']);
    }
}
