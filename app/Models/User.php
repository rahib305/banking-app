<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Statement;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    public function saveTransactionLog($type, $amount, $mail) {
        if($type == 'Deposit') {
            $transactionType = 'Credit';
            $description = 'Deposit';
            $this->increment('balance', $amount);
        } else if($type == 'Withdraw') {
            $transactionType = 'Debit';
            $description = 'Withdraw';
            $this->decrement('balance', $amount);
        } else if($type == 'Transfered') {
            $transactionType = 'Debit';
            $description = 'Transfer to '.$mail;
            $this->decrement('balance', $amount);
        } else if($type == 'Recieved') {
            $transactionType = 'Credit';
            $description = 'Transfer from '.$mail;
            $this->increment('balance', $amount);
        }

        $statement = array(
            'user_id'=>$this->id,
            'transaction_date'=>date('Y-m-d H:i:s'),
            'transaction_type'=> $transactionType,
            'amount'=> $amount,
            'balance'=>$this->balance,
            'description'=>$description
        );
        Statement::create($statement);
        return;
    }
}
