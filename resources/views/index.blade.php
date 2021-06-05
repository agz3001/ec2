@extends("layouts.app")

@section("content")
<div class="container">
  <div class="row">
    <h1>テスト</h1>
    <p>testtest</p>
    <div class="d-flex flex-row flex-wrap">
    @foreach($shops as $shop)
    <div class="col-xs-6 col-sm-4 col-md-4">
      <div class="mycart_box">
        <span>{{$shop->name}}</span>
        <p>{{number_format($shop->fee)}} 円</p>
        <img src="image/retro6.jpg" style="height:200px; width:200px;"><br>
        <p>{{$shop->detail}}</p>
        <form method="post" action="/show">
          @csrf
          <input type="hidden" name="shop_id" value="{{$shop->id}}">
          <input type="submit" value="カートに入れる" class="btn btn-primary">
        </form>
      </div>
    </div>
    @endforeach
    </div>
  </div>
  <div class="text-center" style="width:200px; margin: 20px auto;">
  {{$shops->links()}}
  </div>
</div>

@endsection
