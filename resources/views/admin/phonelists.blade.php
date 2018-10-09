@extends('admin.layouts.admin_app')
@section('title')电话提交列表@stop
@section('head')
<style>td.newcolor span a{color: #ffffff; font-weight: 400; display: inline-block; padding: 2px;} td.newcolor span{margin-left: 5px;}</style>
@stop
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">电话提交列表</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th style="width: 10px">#ID</th>
                            <th>姓名</th>
                            <th>电话</th>
                            <th>备注</th>
                            <th>提交页面</th>
                            <th>IP</th>
                            <th>归属地</th>
                            <th>提交时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($phoneNos as $adminlist)
                        <tr>
                            <td>{{$adminlist->id}}.</td>
                            <td>{{$adminlist->name}}</td>
                            <td>{{substr_replace(decrypt($adminlist->phoneno),'***',3,3)}}</td>
                            <td>{{str_limit($adminlist->note,30,'')}}</td>
                           <td>{{$adminlist->host}}</td>
                           <td>{{$adminlist->ip}}</td>
                            <td>@foreach(\Zhuzhichao\IpLocationZh\Ip::find("$adminlist->ip") as $index=>$area) @if($index<3){{$area}}-@endif @endforeach</td>
                            <td>{{$adminlist->created_at}}</td>
                            <td class="newcolor"><span class="badge bg-green"><a href="/admin/phone/edit/{{$adminlist->id}}">编辑</a></span> <span class="badge bg-red"><a href="/admin/phone/delete/{{$adminlist->id}}">删除</a> </span></td>
                        </tr>
                       @endforeach
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    {!! $phoneNos->links() !!}
                </div>
            </div>
            <!-- /.box -->
        </div>

    </div>
    <!-- /.row -->
    <!-- /.content -->
@stop

