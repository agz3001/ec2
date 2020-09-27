@extends("layouts.app")

@section("content")
<div class="container">
  <div class="">
    <h1>{{Auth::user()->name}}さん,この度はご購入ありがとう御座いました。</h1>
    <div class="container">
      <p>ご登録いただいたメールアドレスへ決済情報をお送りいたします。<br>
      お手続き完了次第、商品を発送致します。</p>
    </div>
    <a href="/" class="btn btn-info">商品一覧へ</a>
  </div>
</div>

@endsection
