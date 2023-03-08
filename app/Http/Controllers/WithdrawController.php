<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\User;
use App\Models\Statement;
class WithdrawController extends Controller
{
    public function Index() {
        return view('withdraw');
    }

    public function withdrawMoney(Request $request) {
        $validated = $request->validate([
            'amount' => 'required|numeric'
        ]);

        $data = array(
            'user_id'=>auth()->user()->id,
            'amount'=>$request->amount
        );
        $user = User::find(auth()->user()->id);

        if($request->amount > $user->balance) {
            return redirect()->back()->withErrors(['msg'=>'You may not have enough balance to pay the amount.Please try with smaller amount!']);
        }
        Withdraw::create($data);

        $user->saveTransactionLog('Withdraw', $request->amount, null);

        return redirect()->back()->with('success', 'Money withdrawed successfully!');
    }
}
