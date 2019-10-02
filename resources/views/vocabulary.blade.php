@extends('layouts.site_layout')

@section('content')
    <!--================start content =================-->
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
            <div class="card-body" style="padding: 1.25rem 0;">
                <div class="row" id="x">
                    <!-- item -->
                    @foreach ($vocas as $index => $voca)
                        <div class="col-md-2">
                            <div class="word_elm" style="{{ $index <= 42 ? 'border-bottom: 1px solid #ececec;':''}}">
                                {{-- <div class="card-img">
                                    <img src="https://placeimg.com/380/230/nature" alt="">
                                    <span>
                                        @if (count($voca->means) > 0)
                                            <h4 style="text-transform: capitalize;">{{$voca->means[0]->type}}</h4>
                                        @endif
                                    </span>
                                </div> --}}
                                <div class="card-desc">
                                    <h3 style="text-transform: capitalize;"><a href="{{route('home_vocabulary_detail', ['word' => $voca->word])}}" style="color: #000;">{{$voca->word}}</a></h3>
                                    <h6>/{{$voca->spelling}}/</h6>
                                    <p><i style="color: blue;">[{{$voca->means[0]->type}}]</i></p>
                                    <p>{{$voca->means[0]->mean}}</p>
                                    {{-- <div class="d-flex justify-content-center">
                                        <a href="#" id="" class="btn btn-outline-primary btn-card" title="Thông tin chi tiết"><i
                                                class="fa fa-info-circle"></i></a>
                                        <a href="#" id="" class="btn btn-outline-success btn-card" title="Thêm vào nhắc nhở"><i
                                                class="fa fa-book"></i></a>
                                        <a href="#" id="" class="btn btn-outline-danger btn-card" title="Báo cáo vi phạm"><i
                                                class="fa fa-exclamation"></i></a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- end item -->
                </div>
            </div>
            <div class="w-full bg-white py-1 px-2 clearfix d-flex justify-content-end"
                style="border-top: 1px solid rgba(0,0,0,0.12);">
                {{ $vocas->appends($urlArr)->links() }}
            </div>
        </div>
    </div>
    
@endsection