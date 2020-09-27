@extends("layouts.app")

@section("content")
<div class="container">
  <div class="container">
    <h1 style="text-align:center;">{{Auth::user()->name}}さんのカートの中身</h1>
    <div class="container">
      <p>{{$message ?? ''}}</p>
      @if(!empty($my_carts))
        @foreach($my_carts as $my_cart)
        <div>
          {{$my_cart->shop->name}}
          <br>
          {{number_format($my_cart->shop->fee)}}
          <br>
          <img src="" style="height:250px; width:250px;">
          <br>
          <form method="post" action="/destroy">
            @csrf
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="shop_id" value="{{$my_cart->shop->id}}">
            <input type="submit" value="カートから削除する" class="btn btn-danger">
          </form>
        </div>
        @endforeach
        <div class="text-center p-2">
          個数: {{count($my_carts)}}個, <!--{{$my_carts->count()}}-->
          <p style="font-size:1.2em; font-weight:bold;">合計金額: {{number_format($join_table_sum)}}円</p>
        </div>
        <a href="/" class="btn btn-success btn-lg text-center buy-btn">ショッピングを続ける</a>
        <form method="post" action="/checkout">
          @csrf
          <input type="submit" value="レジに進む" class="btn btn-danger btn-lg text-center buy-btn">
        </form>
      @else
      <p class="text-center">カートは空っぽです。</p>
      @endif
    </div>
  </div>
</div>

@endsection
