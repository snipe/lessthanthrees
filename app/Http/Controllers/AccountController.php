<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class AccountController extends Controller
{
    public function index()
    {
        echo 'Nothing here yet!';
    }

    public function edit()
    {
        return view('account.edit');
    }

    public function update(Request $request)
    {


        if ($user = User::find(Auth::user()->id)) {

            $rules = User::rules();

            // Only require the password if the user has not set one, or if they
            // entered a value as if to change it
            if ($user->profilePasswordIsRequired($request)) {
                $additional_rules = [
                    'password'              => 'required|min:8|confirmed',
                ];
                $rules += $additional_rules;
                $user->password = bcrypt($request->get('password'));
            }

            $this->validate($request, $rules);
            $user->username = strtolower(str_slug($request->get('username')));
            $user->name = $request->get('name');
            $user->email = $request->get('email');

            if ($user->save()) {
                return back()->with('success','Account updated!');
            }
            return back()->withErrors($user->getErrors());

        } else {
            return back()->with('error','User does not exist.');
        }

    }


    public function getSubscription()
    {
        Auth::user()->fresh();
        if (Auth::user()->subscribed('monthly')) {
            return view('account.payments');
        }
        return view('account.subscription');
    }

    public function processSubscription(Request $request)
    {

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

    public function processCancellation()
    {
        Auth::user()->subscription('monthly')->cancel();
        return redirect()->back()->with('success', 'Your account has been downgraded to a free plan.');
    }

    public function processReactivation()
    {
        Auth::user()->subscription('monthly')->resume();
        return redirect()->back()->with('success', 'Your account has been re-activated!');
    }


}
