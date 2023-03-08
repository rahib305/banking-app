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
        $sender = User::find(auth()->user()->id);
        if(!$recipient) {
            return redirect()->back()->withErrors(['msg'=>'User with this email id is not exist!']);
        } else if($request->email == $sender->email) {
            return redirect()->back()->withErrors(['msg'=>"Something went wrong! Money can't transfer to this email."]);
        }
        if($sender->balance < $request->amount) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors(['msg'=>'You may not have enough balance to pay the amount.Please try with smaller amount!']);
        }
        $data = array(
            'sender_id'=>$sender->id,
            'recipient_id'=>$recipient->id,
            'amount'=>$request->amount
        );
        Transfer::create($data);

        //Sender

        $sender->saveTransactionLog('Transfered', $request->amount, $request->email);

        //Recipient
        // $recipient = User::where('email', $request->email)->first();
        $recipient->saveTransactionLog('Recieved', $request->amount, $sender->email);

        return redirect()->back()->with('success', 'Money Transfered successfully!');
    }
}
