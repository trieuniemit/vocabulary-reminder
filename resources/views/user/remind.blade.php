@extends('layouts.user_layout')

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

@if(isset($arr))
    <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Thông báo nhắc nhở</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <table>
                <tr>
                    <th width="20%">Từ vựng</th>
                    <th width="20%">Mô tả</th>
                </tr>
                @foreach($arr as $item)
                <tr>
                    <td>{{$item->word}}</td>
                    <td>{{$item->spelling}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  @endif


  @if(isset($list))
    <!-- The Modal -->
  <div class="modal fade" id="modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Danh sách nhắc nhở</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <table>
                <tr>
                    <th width="20%">Tiêu đề</th>
                    <th width="30%">Ngày bắt đầu</th>
                    <th width="30%">Ngày kết thúc</th>
                    <th width="20%">Số lượng từ</th>
                    <th width="10%"></th>
                </tr>
                @foreach($list as $item)
                <form action="{{route('remind_delete')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <tr>
                        <td>{{$item->title}} <input type="text" name="idRemind" value="{{$item->id}}" hidden="hidden"></td>
                        <td>{{$item->start_date}}</td>
                        <td>{{$item->end_date}}</td>
                        <td>{{count(explode(',', trim(trim($item->vocabs, ']'),'[')))}}</td>
                        <td><button type="submit" class="btn btn-default">Xóa</button></td>
                    </tr>
                </form>
                @endforeach
            </table>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  @endif

    <!--================start content =================-->
    
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
                            <div class="card-body" id="x">

                            </div>
                        </div>
                        </div>
            </div> 
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Tạo nhắc nhở</button>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                     <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modal">Xem nhắc nhở</button>
                </div>
            </div>
    </form>

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
                    var stringNodes = '';
                    var row = 0;
                    var start = '';
                    var end = '';
                    console.log(response);
                    if(response.length == 0){
                        return;
                    }else {
                    $.each(response,function ( index, repo ) {
                        start = '';
                        end = '';
                        if(row==0) {
                            start = '<div class="row">';
                        } else if(row==4) {
                            end = '</div>';
                            row = -1;
                        }
                        row++;
                        console.log(start);
                        var str = '';
                        Array.from(repo.means).forEach(function (a) {
                            str+=a.mean+',';
                        });
                        str.trim().replace(/^,+|,+$/gm, '');
                    if(repo != null){
                        stringNodes += `
                            ${start}
                            <div class="col-md-2">
                                    <div class="card-content" onclick="getVocaubulary(this)" data-id="${repo.id}">
                                          <div class="card-img">
                                                 <img src="https://placeimg.com/380/230/nature" alt="">
                                                 <div class="success">
                                                    <img src="/img/icon/OK.png"/>
                                                 </div>
                                            </div>
                                                 <div class="card-desc">
                                                       <h3 class=>${repo.word}</h3>
                                                          <h6>${repo.spelling}</h6>
                                                                <p>${str}</p>
                                         </div>
                                    </div>
                             </div>
                             ${end}
                            `;
                    }  
                
                });
                    $('#x').html(stringNodes);
                    }
                },          
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        })

        function getVocaubulary(a){
            var id = $(a).data('id');
            var tuvung = $('#tuvung').val();
            if(tuvung.indexOf(id) < 0) {
                $(a).find('.success').css('display','block');
                $('#tuvung').val(tuvung+id+",");
            } else {
                $(a).find('.success').css('display','none');
                $('#tuvung').val(tuvung.replace(id+",", ''));
            }
        }
        $(window).on('load',function(){
        $('#myModal').modal('show');
        });
        var p=$('.card-desc p');
        var divh=$('.card-desc').height();
        while ($(p).outerHeight()>divh) {
            $(p).text(function (index, text) {
                return text.replace(/\W*\s(\S)*$/, '...');
            });
        }
    </script>
    <style>
    .card-desc {
        height: 210px;
        overflow: hidden;
    </style>
@endsection