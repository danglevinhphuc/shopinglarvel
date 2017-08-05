@extends('client.layout.index')
@section('contentClient')
@section('title')
  Shoping online|Giới thiệu cty
@endsection
<section id="primary" class="main-content clearfix">
		
<!-- Begin breadcrumb -->
  <div class="breadcrumb clearfix">
    <span itemscope="" itemtype="#"><a href="{{route('trangchu')}}" title="LKT Fashion" itemprop="url"><span itemprop="title">Trang chủ</span></a></span>
    <span class="arrow-space">&gt;</span>
    <span itemscope="" itemtype="#">
      Giới thiệu
    </span>
  </div>
<!-- End breadcrumb -->

<div id="page" class="page">
  <header class="page-header">
  	<h1 class="page-title" style="border-bottom: none !important">Giới thiệu</h1>
  </header>
  <div class="page-content entry-content">
    <p>Trang giới thiệu giúp khách hàng hiểu rõ hơn về cửa hàng của bạn. Hãy cung cấp thông tin cụ thể về việc kinh doanh, về cửa hàng, thông tin liên hệ. Điều này sẽ giúp khách hàng cảm thấy tin tưởng khi mua hàng trên website của bạn.</p><p>Một vài gợi ý cho nội dung trang Giới thiệu:</p><div><ul><li><span>Bạn là ai</span><br></li><li><span>Giá trị kinh doanh của bạn là gì</span><br></li><li><span>Địa chỉ cửa hàng</span><br></li><li><span>Bạn đã kinh doanh trong ngành hàng này bao lâu rồi</span><br></li><li><span>Bạn kinh doanh ngành hàng online được bao lâu</span><br></li><li><span>Đội ngũ của bạn gồm những ai</span><br></li><li><span>Thông tin liên hệ</span><br></li><li><span>Liên kết đến các trang mạng xã hội (Twitter, Facebook)</span><br></li></ul></div>.
  </div>
</div>
		</section>
  @endsection