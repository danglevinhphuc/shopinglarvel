@extends('client.layout.index')
@section('contentClient')
@section('title')
  Shoping online| giỏ hàng
@endsection
<?php
  $tong = 0;
?>
<style type="text/css">
  .text1{
        border: 1px solid #e6e6e6;
    padding: 6px 10px;

    outline: none;
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    color: #555;
    margin-left: 130px;
    width: 100px !important;
    max-width: 55%;
    display: block;
    -webkit-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
    -moz-box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
    box-shadow: inset 0 1px 5px rgba(0,0,0,0.1);
    background: #fff;
  }
</style>
<section id="primary" class="main-content clearfix">
		<div id="cart" class="page">
  <header class="page-header">
  	<h1 class="page-title">Giỏ Hàng</h1>
  </header>
  

  <!-- End empty cart -->
  <div class="entry-content page-content clear">
  @if(Cart::count() == 0)
    {{'Giỏ hàng rỗng'}}
  @else
      <form action="/cart" method="post" id="cartform">
        <table>
          <thead>
            <tr>
              <th class="image">Ảnh</th>
              <th class="item">&nbsp;</th>
              <th class="qty">Số lượng</th>
              <th class="price">Đơn giá</th>
              <th class="remove">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cart as $cart)
            <tr>
              <td class="image">
                <div class="product_image">
                  <a href="{{route('chitiet',$cart->id)}}">
                    <img src="storage/app/upload/product/{{$cart->options->hinh}}" width="100px" height="100px">
                  </a>
                </div>
              </td>
              <td class="item">
                <a href="{{route('chitiet',$cart->id)}}">
                  <strong>{{$cart->name}}</strong>
                  
                  <span class="variant_title">{{$cart->options->has('size') ? $cart->options->size : ''}}</span>
                  
                </a>
                
              </td>
              <td class="qty">
                <input type="number" class="text1" min="1" row='{{$cart->rowId}}' size="4" name="updates[]" id="updates_1003673946" value="{{$cart->qty}}"  class="tc item-quantity">
              </td>
              <td class="price">
              
                <div><small class="cart-item__original-price"><s>0₫</s></small></div>
              
              {{number_format($cart->price)}}₫
              
              </td>
              <td class="remove"><a href="{{route('xoacart',$cart->rowId)}}" class="cart">Xóa</a></td>
            </tr>
            <?php
                  $tong = $tong+ ($cart->price*$cart->qty);
              ?>
            @endforeach
            
          </tbody>
        </table>
         <table>
            <tbody>
            <tr class="summary">
              <td class="price">
                
                <span class="total">
                  <span class="label">Tổng</span>

                  <span class="h3"><strong>{{number_format($tong)}}₫</strong></span>

                </span>
                
              </td>
            </tr>
          </tbody>
        </table>

        <div class="cart-buttons">
          <p class="cart-subtotal__note"><em>Phí vận chuyển, thuế, giảm giá sẽ được tính lúc thanh toán</em></p>
          <div class="buttons clearfix">
            <a href="{{route('thanhtoan')}}"><input type="button" id="checkout" class="btn" name="checkout" value="Thanh toán"></a>
            <a href="{{route('cart')}}"><input type="button" id="update-cart" class="btn" name="update" value="Cập nhật"></a>
          </div>
        </div>
      </form>
      @endif
  <!-- End cart -->
  </div>
  <!-- Begin cart -->
  
  
  
  <!-- End cart -->
  </div>



		</section>
@endsection

@section('script')

<script type="text/javascript">  
    $(document).ready(function(){
      $('.text1').on('keyup',function(){
        let qty = $(this).val();
        let rowId = $(this).attr('row');
        // gui du lieu den server cap nhat
        // gom co so luong va id san pham
        $.get("updatecart/"+qty+"/"+rowId,function(data){
                });
      });
    });
</script>

@endsection