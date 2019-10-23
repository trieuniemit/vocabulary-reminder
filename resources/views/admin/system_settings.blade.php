@extends('layouts.admin_layout')

@section('content')
<div class="login_wrap p_120" style="padding-top: 80px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('admin_setting')}}" class="login_form" method="post">
                    @csrf

                    @if($errors->has('errorlogin'))
                        <div class="alert alert-danger" style="margin-top: 20px;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{$errors->first('errorlogin')}}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="facebook">Đường dẫn facebook</label>
                        @if($errors->has('facebook'))
							<p style="color:red">{{$errors->first('facebook')}}</p>
						@endif
                        <input type="text" class="form-control" name="facebook" id="facebook" value="" placeholder="Tên đăng nhập">
                      </div>
                      <div class="form-group">
                        <label for="youtube">Đường dẫn youtebe</label>
                        @if($errors->has('youtube'))
							<p style="color:red">{{$errors->first('youtube')}}</p>
						@endif
                        <input type="text" class="form-control" name="youtube" id="youtube" value="" placeholder="Nhập họ và tên">
                      </div>
                      <div class="form-group">
                        <label for="twitter">Đường dẫn twitter</label>
                        @if($errors->has('twitter'))
							<p style="color:red">{{$errors->first('twitter')}}</p>
						@endif
                        <input type="twitter" class="form-control" name="twitter" id="twitter" value="" placeholder="Nhập địa chỉ email">
                      </div>
                      <div class="form-group">
                        <label for="can_register" class="control-label">Cho phép thành viên đăng ký mới</label>
                        <select type="can_register" name="can_register" class="form-control wide" id="can_register">
                            <option value="1">Có</option>
                            <option value="0">Không</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="can_comment" class="control-label">Cho phép thành viên bình luận</label>
                        <select type="can_comment" name="can_comment" class="form-control wide" id="can_comment">
                            <option value="1">Có</option>
                            <option value="0">Không</option>
                        </select>
                      </div>
                    <div class="row" style="padding-top: 30px">
                        <div class="col-sm-6">
                            <div class="login_btn">
                                <button type="button" onclick="window.history.back();" class="btn btn-info">< Quay lại</button>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="login_btn">
                                <button type="submit" class="btn btn-success">Lưu cài đặt</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
