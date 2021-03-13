<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function transactionDetail(){
    	return $this->hasMany('App\TransactionDetails','productId','id');
    }
}
