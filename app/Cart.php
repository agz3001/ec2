<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Cart extends Model
{
    protected $guarded =array("id");
    protected $fillable =["shop_id", "user_id"];

    public function shop(){
      return $this->belongsTo("App\Shop");
    }

    public function checkoutCart(){
       $user_id = Auth::id();
       $checkout_items=$this->where('user_id', $user_id)->get();
       $this->where('user_id', $user_id)->delete();

       return $checkout_items;     
    }

}
