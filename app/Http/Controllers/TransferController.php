<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transfer;
use App\Models\Statement;
class TransferController extends Controller
{
    public function Index() {
        return view('transfer');
    }

    public function transferMoney(Request $request) {
        $validated = $request->validate([
            'email'=> 'required|email',
            'amount' => 'required|numeric'
        ]);

        $recipient = User::where('email', $request->email)->first();
        if(!$recipient) {
            return redirect()->back()->withErrors(['msg'=>'User with this email id is not exist!']);
        }
        if(auth()->user()->balance < $request->amount) {
            return redirect()->back()->withErrors(['msg'=>'You may not have enough balance to pay the amount.Please try with smaller amount!']);
        }
        $data = array(
            'sender_id'=>auth()->user()->id,
            'recipient_id'=>$recipient->id,
            'amount'=>$request->amount
        );
        Transfer::create($data);

        //Sender
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

        //Recipient
        User::where('id', $recipient->id)
                ->increment('balance', $request->amount);
        $user = User::find($recipient->id);
        $statement = array(
            'user_id'=>$recipient->id,
            'transaction_date'=>date('Y-m-d H:i:s'),
            'transaction_type'=> 'Credit',
            'amount'=> $request->amount,
            'balance'=>$user->balance
        );
        Statement::create($statement);

        return redirect()->back()->with('success', 'Money Transfered successfully!');
    }
}
