<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AccountController extends Controller
{
    public function index() {

        echo 'Nothing here yet!';
    }

    public function getSubscription() {
        Auth::user()->fresh();
        if (Auth::user()->subscribed('monthly')) {
            return view('account.payments');
        }
        return view('account.subscription');
    }

    public function processSubscription(Request $request) {

        $subscription = Auth::user()->newSubscription('monthly', 'LT3-MONTHLY');

        if ($request->has('coupon')) {
            $subscription->withCoupon('code');
        }

        // Create the subscription
        try {
            $subscription->create($request->input('stripeToken'));
            return redirect()->route('account.subscription')->with('success','You have been subscribed!' );
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Something went wrong while trying to authorise your card: '.$e->getMessage().'');
        }


    }

    public function processCancellation() {
        Auth::user()->subscription('monthly')->cancel();
        return redirect()->back()->with('success', 'Your account has been downgraded to a free plan.');
    }

    public function processReactivation() {
        Auth::user()->subscription('monthly')->resume();
        return redirect()->back()->with('success', 'Your account has been re-activated!');
    }


}
