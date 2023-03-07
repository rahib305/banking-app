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
        Withdraw::create($data);

        User::where('id', auth()->user()->id)
                    ->decrement('balance', $request->amount);
        $user = User::find(auth()->user()->id);
        $statement = array(
            'user_id'=>auth()->user()->id,
            'transaction_date'=>date('Y-m-d H:i:s'),
            'transaction_type'=> 'Debit',
            'amount'=> $request->amount,
            'balance'=>$user->balance
        );
        Statement::create($statement);
        return redirect()->back()->with('success', 'Money withdrawed successfully!');
    }
}
