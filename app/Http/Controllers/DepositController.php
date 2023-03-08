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

        $user = User::find(auth()->user()->id);
        $user->saveTransactionLog('Deposit', $request->amount, null);

        return redirect()->back()->with('success', 'Money deposited successfully!');
    }
}
