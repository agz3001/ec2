<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Shop;
use App\Cart;
use App\Mail\Thanks;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops =Shop::Paginate(6);
        return view("index", compact("shops"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id =Auth::id();
        $shop_id =$request->shop_id;
        $cart_add_info =Cart::firstOrCreate(['shop_id'=>$shop_id, 'user_id'=>$user_id]);
        if($cart_add_info->wasRecentlyCreated){//firstOrCreate:データの取得と登録を同時に行う
            $message = 'カートに追加しました';
        } else {
            $message = 'カートに登録済みです';
        }
        $my_carts = Cart::where('user_id',$user_id)->get();
        return redirect()->route('show',compact('my_carts', 'message'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
      $user_id =Auth::id();
      $my_carts =Cart::where('user_id',$user_id)->get();
      $join_table_sum =Cart::select()->join("shops", "shops.id", "=", "carts.shop_id")->sum("fee");//inner_join, sum()
      //$data =DB::select("select sum(fee) from shops");
      //ddd($data);
      return view("show", compact("my_carts", "join_table_sum"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user_id =Auth::id();
        $shop_id =$request->shop_id;//商品id取ってくる
        //$delete =Cart::where("user_id", $user_id)->where("shop_id", $shop_id)->delete();
        $delete =Cart::where("shop_id", $shop_id)->delete();//商品id削除、メッセージ付与
        if ($delete >0){
          $message ="カートから1つの商品を削除しました。";
        } else {
          $message ="削除に失敗しました。";
        }
        $my_carts = Cart::where('user_id',$user_id)->get();//カートの中身整理
        $join_table_sum =Cart::select()->join("shops", "shops.id", "=", "carts.shop_id")->sum("fee");//カートの中身整理
        return view("show", compact("message", "my_carts", "join_table_sum"));

    }

    public function checkout(Request $request, Cart $cart)
    {/*
        $user_id =Auth::id();
        $user =Auth::user();
        $checkout_items =Cart::where("user_id", $user_id)->get();

        Mail::to(Auth::user()->email)->send(new Thanks($checkout_items));
        $checkout_items =Cart::where("user_id", $user_id)->delete();
        return view('checkout', compact("user", "checkout_items"));*/

        $user = Auth::user();
        $mail_data['user']=$user->name;
        $mail_data['checkout_items']=$cart->checkoutCart();
        Mail::to($user->email)->send(new Thanks($mail_data));
        return view('checkout');

    }
}
