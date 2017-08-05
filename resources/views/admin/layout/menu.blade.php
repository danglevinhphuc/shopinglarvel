<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        
                        <li>
                            <a href="{{ asset('') }}" target="_blank"><i class="fa fa-undo fa-fw"></i> Quay về trang bán hàng</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i>Danh mục sản phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('danhsachcategory')}}">Danh Sách</a>
                                </li>
                                <li>
                                    <a href="{{route('themcategory')}}">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sliders fa-fw"></i>Slide<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('danhsachslide')}}">Danh Sách</a>
                                </li>
                                <li>
                                    <a href="{{route('themslide')}}">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-product-hunt fa-fw"></i>Sản Phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('danhsachproducts')}}">Danh Sách</a>
                                </li>
                                <li>
                                    <a href="{{route('themproducts')}}">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{route('danhsachuser')}}">Danh Sách</a>
                                </li>
                                <li>
                                    <a href="{{route('dangky')}}">Thêm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>