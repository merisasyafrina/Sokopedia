<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionHeaders extends Model
{
    protected $table = "transactionheaders";
    
    public function user(){ 
        return $this->belongsTo('App\User','userId','id'); 
    }

    public function transactionDetail(){
    	return $this->hasMany('App\TransactionDetails','transactionHeaderId','id');
    }
}
