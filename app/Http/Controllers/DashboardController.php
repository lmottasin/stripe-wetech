<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileSave;
use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class DashboardController extends Controller
{

    public function profile(){
        return view('settings/profile');
    }
    public function profile_save(ProfileSave $request){
        $user = Auth::user();

        // validate the response
        $data = $request->validated();

        // save the user info
        $user->name = $data['name'];
        $user->email = $data['email'];



        if ($request->hasFile('photo')) {

            $photo = $data['photo'];
            $filename = Str::slug($data['name']) . '-' . uniqid() . '.' . $photo->extension();

            // if php 8.1.6 need to uncomment' upload_tmp_dir =' in php.ini and add temp director
            // in windows it is c/windows/temp
            $photo->storeAs('public/images/users', $filename);

            $user->photo = $filename;
        }

        $user->save();

        return back()->with(['alert' => 'Successfully updated your profile info', 'alert_type' => 'success']);
    }

    public function security(){
        return view('settings/security');
    }
    public function security_save(Request $request){

        $user = Auth()->user();

        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with(['alert' => 'Successfully updated your password', 'alert_type' => 'success']);
    }

    public function invoices(){
        $invoices = Auth::user()->invoices();
        return view('settings.invoices',[
            'invoices'=>$invoices
        ]);
    }
    public function invoices_download(Request $request,$invoiceId){
        return $request->user()->downloadInvoice($invoiceId, [
            'vendor' => 'Weteach',
            'product' => 'Codeshaper',
        ]);
    }

    public function cancel(){
        Auth::user()->subscription('main')->cancel();
        return back()->with(['alert' => 'Successfully cancelled you account!', 'alert_type' => 'success']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
