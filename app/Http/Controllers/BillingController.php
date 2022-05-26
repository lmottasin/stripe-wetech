<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Plan;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function billing()
    {
        $plans = Plan::all();
        return view('settings/billing',[
            'plans'=>$plans,
        ]);
    }

    public function billing_save(Request $request)
    {
        $user = auth()->user();

        try {
            if ($user->subscribed('main')) {
                // update their credit card
                $user->updateDefaultPaymentMethod($request->payment_method);

            } else {
                $plan = Plan::where('pricing_api_id', '=', $request->pricing_api_id)->first();
                $user->plan_id = $plan->id;
                $user->update();

                $user->newSubscription('main', $request->pricing_api_id)->create($request->payment_method);
            }
        } catch(Exception $e){
            return back()->with(['alert' => 'Something went wrong submitting your billing info', 'alert_type' => 'error']);
        }

        return back()->with(['alert' => 'Successfully updated your billing info', 'alert_type' => 'success']);
    }

    public function switch_plan (Request $request) {
        try{
            $plan = Plan::where('pricing_api_id', '=', $request->pricing_api_id)->firstOrFail();
            $user = auth()->user();
            $user->subscription('main')->swap($request->pricing_api_id);
            $user->plan_id = $plan->id;
            $user->update();

        } catch(Exception $e){
            return back()->with(['alert' => 'Sorry, there was an error switching plans.', 'alert_type' => 'error']);
        }
        return back()->with(['alert' => 'Successfully switched your plan', 'alert_type' => 'success']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Billing $billing
     * @return \Illuminate\Http\Response
     */
    public function show(Billing $billing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Billing $billing
     * @return \Illuminate\Http\Response
     */
    public function edit(Billing $billing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Billing $billing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Billing $billing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Billing $billing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing $billing)
    {
        //
    }
}
