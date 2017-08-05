@include("client.layout.header")
<style type="text/css">
	a:hover{
		text-decoration: none !important;
	}
</style>
<body class="home">
	@include("client.layout.top-menu")	
	@include("client.layout.slide")	
	<div id="container" class="wrapper fix-width">
		@yield('contentClient')
		@include("client.layout.category")	
	</div>
	@yield('script')
@include("client.layout.footer")