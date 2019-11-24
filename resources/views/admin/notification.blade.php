@extends('layouts.admin_layout')

@section('content')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
                 data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    {{--                    <h2>Quản lý từ vựng</h2>--}}
                    {{--                    <div class="page_link">--}}
                    {{--                        <a href="index.html">Trang chủ</a>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->


    <!--================start content =================-->

    <div class="card mb-3">
        <div class="card">
            <div class="card-header">
                <h5>quản lý từ vựng xxx</h5>
            </div>
            <div class="card-body">
                <table id="tblresult" class="table table-striped table-bordered">
                    <thead>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung thông báo</th>
                    <th>Người nhận</th>
                    <th>Thao tác</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="btnAdd" name="btnAdd"><i class="fa fa-plus"></i>&nbsp; Thêm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="appdetail" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" style="max-width: 1200px;">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title" id="modalTitle"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" class="form-horizontal" id="frmPost">
                        @csrf

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Đối tượng</label>
                                <select name="userid" id="userid" style="width: 100%">
                                    <option value="0">-- Chọn --</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tiêu đề</label>
                                <input name="title" type="text" placeholder="Không để trống" class="form-control">
                            </div>
                        </div>
                        <div class="form-group ">
                            <label>Nội Dung</label>
                            <input name="content" type="text" class="form-control">
                        </div>
                    </form>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success" form="frmPost" id="btnSubmitDetail">Cập nhật</button>
                </div>
            </div>
        </div>
    </div>
    <!-- The Modal appConfirm-->
    <div class="modal fade" id="appConfirm">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <h5></h5>
                    <form method="post" class="form-horizontal" id="frmDelete">
                        @csrf
                        <input type="hidden" id="idx" name="idx">
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-success" form="frmDelete" id="btnSubmitConfirm">Xóa</button>
                </div>

            </div>
        </div>
    </div>
    <!--! The Modal appConfirm-->

    <!--================End content =================-->

@endsection

@section('script')
    <script src="/js/admin/Notification.js"></script>
@endsection
