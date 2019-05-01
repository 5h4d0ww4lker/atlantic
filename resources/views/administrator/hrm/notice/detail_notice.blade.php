@extends('administrator.master')
@section('title', 'Notice Details')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            NOTICE
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{ url('/hrm/notices') }}">Manage Notices</a></li>
            <li class="active">Notice Details</li>
        </ol>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Notice Details</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <a href="{{ url('/hrm/notice') }}" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> Back</a>
            <hr>
            <table id="example1" class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td width="25%">Title</td>
                        <td width="75%">{{ $notice->name }}</td>
                    </tr>
                   
                    <tr>
                        <td>From Date</td>
                        <td>{{ date("D d F Y h:ia", strtotime($notice->from_date)) }}</td>
                    </tr>
                    <tr>
                        <td>To Date</td>
                        <td>{{ date("D d F Y h:ia", strtotime($notice->to_date)) }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{!! $notice->description !!}</td>
                    </tr>
                    <tr>
                        <td>Create By</td>
                        <td>
                            @foreach($users as $user)
                            @if($user->id == $notice->created_by)
                            {{ $user->name }}&nbsp; {{ $user->father_name }}&nbsp; {{ $user->grand_father_name }}
                            @endif
                            @endforeach
                        </td>
                    </tr>

                     <tr>
                        <td>Date Added</td>
                        <td>{{ date("D d F Y h:ia", strtotime($notice->created_at)) }}</td>
                    </tr>
                    
                   
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
</section>
<!-- /.content -->
</div>
@endsection