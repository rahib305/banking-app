<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Statement extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function getDateTimeAttribute() {
        $date = Carbon::parse($this->transaction_date);
        return $date->format('d-m-Y h:i A');
    }

    protected $appends = ['date_time'];
}
