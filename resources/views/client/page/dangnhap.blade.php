@extends('client.layout.index')
@section('contentClient')
@section('title')
  Shoping online| Đăng nhập
@endsection
<style type="text/css">
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
                <div class="alert alert-danger">
                    {{Session::get('thanhcong')}}
                </div>
                @endif
		<div id="customer-login" class="page">
	<header class="page-header">
      <h1 class="page-title">Đăng nhập</h1>
	</header>
	<div class="entry-content page-content">
		<div id="login" class="login-form userbox">
	      <form accept-charset="UTF-8" action="{{route('postdangnhap')}}" id="customer_login" method="post">
<input name="form_type" type="hidden" value="customer_login">
<input name="utf8" type="hidden" value="✓">
<input type="hidden" name="_token" value="{{csrf_token()}}">
	      
	      <p class="icon-title"><span class="fa fa-user"></span></p>
	      <p class="field">
	      	<label class="icon-field" for="customer_email">
				<i class="fa fa-envelope"></i>
			</label>
			<input type="email" value="" name="email" id="customer_email" class="text" placeholder="Email">
		</p>
	      
	      
	      <p class="field">
	      	<label class="icon-field" for="customer_password">
				<i class="fa fa-lock"></i>
			</label>
	      	<input type="password" value="" name="password" id="customer_password" class="text" placeholder="Mật khẩu">
	      </p>
	      
	
	      <div class="action_bottom">
	        <input class="btn" type="submit" value="Đăng nhập">
	      </div>
	      </form>
	    </div>

	    

  </div>
</div>

<script type="text/javascript">
  function showRecoverPasswordForm() {
    document.getElementById('recover-password').style.display = '';
    document.getElementById('login').style.display='none';
  }

  function hideRecoverPasswordForm() {
    document.getElementById('recover-password').style.display = 'none';
    document.getElementById('login').style.display = '';
  }

  if (window.location.hash == '#recover') { showRecoverPasswordForm() }
</script>

		</section>
		@endsection