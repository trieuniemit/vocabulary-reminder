@extends('layouts.user_layout')

@section('content')
    <!--================start content =================-->

<div class="row" style="padding-top: 10px;padding-bottom: 20px;">
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
                <button class="btn btn-success"><i class="fa fa-filter"></i></button>
            </form>
        </div>
    </div>
</div>

<div class="row" id="x">
    <div class="col-md-12">
    <!-- item -->
    @foreach ($vocas as $index => $voca)
        @php
            $mean = isset($voca->means[0])? $voca->means[0]: (object)['type' => 'Not found', 'mean' => 'Not found'];
        @endphp
        <div class="word_elm">
            <h5 style="text-transform: capitalize;margin: 0;" class="show_tooltip" data-toggle="tooltip" data-placement="bottom" data-html="true" 
                title="<span style='text-align: left; padding-top: 15px'><b style='text-transform: capitalize;'>{{$voca->word}}</b>
                    <span style='text-transform: capitalize;'>/{{$voca->spelling}}/</span><br>
                    <i style='color: green;'>[{{$mean->type}}]</i><br>
                    <p>{{ucfirst($mean->mean)}}</p></span>
                ">
                <a href="{{route('home_vocabulary_detail', ['word' => $voca->word])}}" style="color: #000;">{{$voca->word}}</a>
            </h5>
        </div>
    @endforeach
    <!-- end item -->
    </div>
</div>

<div class="w-full bg-white py-1 px-2 clearfix d-flex justify-content-end" style="border-top: 1px solid rgba(0,0,0,0.12);margin-top: 20px;">
    {{ $vocas->appends($urlArr)->links() }}
</div>
    
@endsection
