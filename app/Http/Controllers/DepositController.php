<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Statement;
class DepositController extends Controller
{
    public function Index() {
        return view('deposit');
    }

    public function depositMoney(Request $request) {
        $validated = $request->validate([
            'amount' => 'required|numeric'
        ]);

        $data = array(
            'user_id'=>auth()->user()->id,
            'amount'=>$request->amount
        );
        Deposit::create($data);

        User::where('id', auth()->user()->id)
                    ->increment('balance', $request->amount);
        $user = User::find(auth()->user()->id);
        $statement = array(
            'user_id'=>auth()->user()->id,
            'transaction_date'=>date('Y-m-d H:i:s'),
            'transaction_type'=> 'Credit',
            'amount'=> $request->amount,
            'balance'=>$user->balance
        );
        Statement::create($statement);
        return redirect()->back()->with('success', 'Money deposited successfully!');
    }
}
