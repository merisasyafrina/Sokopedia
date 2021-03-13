<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetails extends Model
{
    protected $table = "transactiondetails";

    public function product(){
    	return $this->belongsTo('App\Product','productId','id');
    }

    public function transaction(){
    	return $this->belongsTo('App\TransactionHeader','transactionHeaderId','id');
    }
}
