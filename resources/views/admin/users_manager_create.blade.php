@extends('layouts.admin_layout')

@section('content')
<div class="login_wrap p_120" style="padding-top: 80px">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('user_profile')}}" class="login_form" method="post">
                    @csrf

                    @if($errors->has('errorlogin'))
                        <div class="alert alert-danger" style="margin-top: 20px;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{$errors->first('errorlogin')}}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        @if($errors->has('username'))
							<p style="color:red">{{$errors->first('username')}}</p>
						@endif
                        <input type="text" class="form-control" name="username" id="username" value="{{old('username')}}" placeholder="Tên đăng nhập">
                      </div>
                      <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        @if($errors->has('fullname'))
							<p style="color:red">{{$errors->first('fullname')}}</p>
						@endif
                        <input type="text" class="form-control" name="fullname" id="fullname" value="{{old('fullname')}}" placeholder="Nhập họ và tên">
                      </div>
                      <div class="form-group">
                        <label for="email">Địa chỉ email</label>
                        @if($errors->has('email'))
							<p style="color:red">{{$errors->first('email')}}</p>
						@endif
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="Nhập địa chỉ email">
                      </div>
                      <div class="form-group">
                        <label for="gender" class="control-label">Giới tính</label>
                        <select type="gender" name="gender" class="form-control wide" id="gender">
                            <option value="0">Nữ</option>
                            <option value="0">Nam</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="role" class="control-label">Quyền</label>
                        <select type="gender" name="gender" class="form-control wide" id="gender">
                            <option value="1">Administrator</option>
                            <option value="2">Vocabulary Manager</option>
                            <option value="3">User</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="birthday" class="control-label">Ngày sinh</label>
                        @if($errors->has('birthday'))
							<p style="color:red">{{$errors->first('birthday')}}</p>
						@endif
                        <input type="date" name="birthday" class="form-control wide" id="birthday" required>
                      </div>
                    <div class="row" style="padding-top: 30px">
                        <div class="col-sm-6">
                            <div class="login_btn">
                                <button type="button" onclick="window.history.back();" class="btn btn-info">< Quay lại</button>
     
                                <button type="submit" class="btn btn-success">Lưu lại</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection