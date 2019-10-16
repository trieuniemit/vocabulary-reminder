@extends('layouts.site_layout')

@section('content')
<div class="login_wrap p_120">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Đăng nhập</h1>
            </div>
            <div class="col-md-12">
                <form action="{{route('login_post')}}" class="login_form" method="post">
                    @csrf

                    @if($errors->has('errorlogin'))
                        <div class="alert alert-danger" style="margin-top: 20px;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{$errors->first('errorlogin')}}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="email">Địa chỉ email</label>
                        @if($errors->has('email'))
							<p style="color:red">{{$errors->first('email')}}</p>
						@endif
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="Nhập địa chỉ email">
                      </div>
                      <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        @if($errors->has('password'))
							<p style="color:red">{{$errors->first('password')}}</p>
						@endif
                        <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="remember_me" checked> Ghi nhớ mật khẩu?
                        </label>
                      </div>
                    <div class="login_social">
                        <a href="#" class="btn-login-with facebook">
                            <i class="fa fa-facebook-official"></i>
                            Đăng nhập với Facebook
                        </a>
                        <a href="#" class="btn-login-with google">
                            <i class="fa fa-facebook-official"></i>
                            Đăng nhập với Google
                        </a>
                    </div>    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="login_btn">
                                <button type="button" onclick="window.history.back();" class="btn btn-info">< Quay lại</button>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="login_btn">
                                <button type="submit" class="btn btn-success">Đăng nhập</button>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection