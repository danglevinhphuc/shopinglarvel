@extends('client.layout.index')
@section('contentClient')
@section('title')
  Shoping online| Đăng ký
@endsection
<style type="text/css">
	.fa1{
		margin-top: 30px !important;
	}
	.page-header{
		border-bottom: none !important;
	}
	.page-content{
		margin-top: -20px;
	}
</style>
<section id="primary" class="main-content clearfix">
 @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    {{$err}}<br/>
                    @endforeach
                </div>
                @endif

                @if(Session::has("thanhcong"))
                <div class="alert alert-success">
                    {{Session::get('thanhcong')}}
                </div>
                @endif
		<div id="customer-register" class="page">
	<header class="page-header">
		<h1 class="page-title">
			Đăng ký thành viên
		</h1>
	</header>
  <div class="entry-content page-content">
    <div id="register" class="userbox">

	    <form accept-charset="UTF-8" action="{{route('postdangky')}}" id="create_customer" method="post">
<input name="form_type" type="hidden" value="create_customer">
<input name="utf8" type="hidden" value="✓">
<input type="hidden" name="_token" value="{{csrf_token()}}">

	      

	      <p id="first_name" class="clearfix field">
	        <label for="first_name" class="label"><i class="fa fa1 fa-user"></i></label>
	        <input type="text" value="" name="name" id="first_name" class="text" placeholder="Họ và Tên">
	      </p>
	      <p id="email" class="field">
	        <label for="email" class="label"><i class="fa fa1 fa-envelope"></i></label>
	        <input type="email" value="" name="email" id="email" class="text" placeholder="Email">
	      </p>

	      <p id="password" class="field">
	        <label for="password" class="label"><i class="fa fa1 fa-lock"></i></label>
	        <input type="password" value="" name="password" id="password" class="password text" placeholder="Mậu khẩu">
	      </p>
	      <div class="action_bottom">
	        <input class="btn" type="submit" value="Đăng ký">
	        
	      </div>
			
	    </form>

    </div><!-- #register -->
  </div><!-- .row -->
</div><!-- #customer-register -->

		</section>
@endsection