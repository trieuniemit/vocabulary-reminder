@extends('layouts.admin_layout')

@section('content')
 <!-- DataTables Example -->
 <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Quản lý người dùng <a style="margin-left: 20px;" href="{{route('users.create')}}"><i class="fas fa-plus"></i></a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Tên người dùng</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Trạng thái</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Tên người dùng</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Giới tính</th>
                    <th>Ngày sinh</th>
                    <th>Trạng thái</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->username}}</td>
                        <td>{{$user->fullname}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->gender==1?'Nữ': 'Nam'}}</td>
                        <td>{{$user->birthday}}</td>
                        <td>{!! $user->status==0?'<span style="color:green">Ngừng hoạt động</span>': '<span style="color:green">Hoạt động</span>' !!}</td>
                        <td style="text-align: center">
                            <a href="{{route('users.index')}}/{{$user->id}}/edit" style="color:green"><i class="fas fa-edit" aria-hidden="true"></i></a> | 
                            <form style="display: inline" action="{{route('users.index')}}/{{$user->id}}" method="post">
                                <button type="submit" style="color: red;padding: 0;border-width: 0px;background: none;"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                {{ method_field('DELETE') }}
                                {!! csrf_field() !!}
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>
    </div>
@endsection