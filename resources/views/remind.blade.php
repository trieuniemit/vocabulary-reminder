@extends('layouts.site_layout')

@section('content')
<!--================Home Banner Area =================-->
    <section class="banner_area">
            <div class="banner_inner d-flex align-items-center">
                <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0"
                    data-background=""></div>
                <div class="container">
                    <div class="banner_content text-center">
                        <h2>Nhắc nhở học từ vựng</h2>
                        <div class="page_link">
                            <a href="index.html">Trang chủ</a>
                            <a href="blog.html">Nhắc nhở</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!--================End Home Banner Area =================-->


    <!--================start content =================-->
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h5>Nhắc nhở học từ vựng</h5>
            </div>
            <div class="card-body">
                <div class="container">
                    <h2>Tạo nhắc nhở học tiếng anh</h2>
                    <form class="form-horizontal" action="{{route('remind_post')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="tieude">Tiêu đề:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="tieude" placeholder="Nhập tiêu đề"
                                    name="tieude">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="ngaybatdau">Ngày bắt đầu:</label>
                            <div class="col-sm-4">
                                <input type="Date" class="form-control" id="ngaybatdau" name="ngaybatdau">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="ngayketthuc">Ngày kết thúc:</label>
                            <div class="col-sm-4">
                                <input type="Date" class="form-control" id="ngayketthuc" name="ngayketthuc">
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="tuvung" name="tuvung">
                     <div class="form-group">
                            <label class="control-label col-sm-2" for="search">Tìm kiếm từ:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="search">
                            </div>
                             <div class="card-body card-block">
                                    <div class="content">
                                            <div class="card-body">
                                                <div class="row" id="x">
                                                </div>
                                    
                                            </div>
                                        </div>
                                        </div>
                            </div> 
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="ghichu">Ghi chú:</label>
                                <div class="col-sm-4" >
                                    <input type="text" class="form-control" id="ghichu" placeholder="Ghi chú"
                                        name="ghichu">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Tạo nhắc nhở</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $('#search').on('keyup',function(){
            if($('#search').val() == "") {
                $('#x').html('');
                return;
            }
            $.ajax({
                url: "/api/search",
                type: "post",
                data: {
                    search : $('#search').val()
                },
                success: function (response) {
                    $('#x').html('');
                    console.log(response);
                    if(response.length == 0){
                        return;
                    }else {
                    $.each(response,function ( index, repo ) {
                        var str = '';
                        Array.from(repo.means).forEach(function (a) {
                            str+=a.mean+',';
                        });
                        str.replace(/\,+$/g, '');
                    if(repo != null){
                        $('#x').append(`
                    <div class="col-md-2">
                            <div class="card-content" onclick="getVocaubulary(this)" data-id="${repo.id}">
                                  <div class="card-img">
                                         <img src="https://placeimg.com/380/230/nature" alt="">
                                         <div class="success">
                                            <img src="img/icon/OK.png"/>
                                         </div>
                                                <span>
                                                    <h4>Danh từ</h4>
                                                </span>
                                                            </div>
                                                            <div class="card-desc">
                                                                <h3 class=>${repo.word}</h3>
                                                                <h6>${repo.spelling}</h6>
                                                                <p>${str}</p>
                                                                <div class="d-flex justify-content-center">
                                                                    <a href="#" id="" class="btn btn-outline-primary btn-card" title="Thông tin chi tiết"><i
                                                                            class="fa fa-info-circle"></i></a>
                                                                    <a href="#" id="" class="btn btn-outline-success btn-card" title="Thêm vào nhắc nhở"><i
                                                                            class="fa fa-book"></i></a>
                                                                    <a href="#" id="" class="btn btn-outline-danger btn-card" title="Báo cáo vi phạm"><i
                                                                            class="fa fa-exclamation"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                    `)
                    }  
                
                });
                    }
                },          
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        })

        function getVocaubulary(a){
            var id = $(a).data('id');
            $(a).find('.success').css('display','block');
            var tuvung = $('#tuvung').val();
            if(tuvung.indexOf(id) <= 0) {
                $('#tuvung').val(tuvung+id+",");
            }
        }
    </script>
@endsection