@extends('layouts.site_layout')

@section('content')

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v4.0&appId=156321928365097&autoLogAppEvents=1"></script>

<div class="container">
        <div class="content">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-7">
                            <form action="" class="form-inline">
                                <div class="form-group" style="margin: 0 5px;">
                                    <input type="text" name="q" id="search" value="{{request()->q}}" class="form-control" placeholder="Nhập từ cần tra...">
                                </div>
                                <button class="btn btn-success"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="col-md-5">
                            <div class="topnav">
                                <form action="" class="form-inline" style="justify-content: flex-end;">
                                    <div class="form-group" style="margin: 0 5px;">
                                        <select name="type" value="{{request()->type}}">
                                            <option value="all">---- Từ loại ----</option>
                                            <option value="danh từ">Danh từ</option>
                                            <option value="động từ">Động từ</option>
                                            <option value="tính từ">Tính từ</option>
                                            <option value="ngoại động từ">Ngoại động từ</option>
                                            <option value="trạng từ">Trạng từ</option>
                                            <option value="giới từ">Giới từ</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="cat" value="all">
                                    {{-- <div class="form-group" style="margin: 0 5px;">
                                        <select name="cat" data-val="{{request()->cat}}">
                                            <option value="all">---- Chủ đề ----</option>
                                            <option value="2">Xe cộ</option>
                                            <option value="4">Công nghệ thông tin</option>
                                            <option value="5">Thức ăn</option>
                                        </select>
                                    </div> --}}
                                    <button class="btn btn-success"><i class="fa fa-filter"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full bg-white"
                style="border-bottom: 1px solid rgba(0,0,0,0.12); margin-top: 50px">
                <h1>{{$voca->word}} <span style="font-size: 20px;color: #007bff">/{{$voca->spelling}}/</span></h1>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @foreach($voca->means as $mean)
                        <div class="mean_item">
                            <h4>[{{$mean->type}}]</h4>
                            <p>{{$mean->mean}}</p>
                        </div>
                    @endforeach
                    <div class="fb-comments" data-href="{{URL::current()}}" data-width="100%" data-numposts="5"></div>
                </div>
            </div>
        </div>
    </div>
@endsection