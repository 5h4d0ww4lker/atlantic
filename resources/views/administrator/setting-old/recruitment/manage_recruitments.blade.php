@extends('administrator.master')
@section('title', 'Recruitments')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            RECRUITMENT
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>Setting</a></li>
            <li class="active">Recruitments</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Manage recruitments</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <a href="{{ url('/setting/recruitments/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Add recruitment</a>
                <hr>
                <!-- Notification Box -->
                <div class="col-md-12">
                    @if (!empty(Session::get('message')))
                        <div class="alert alert-success alert-dismissible" id="notification_box">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-check"></i> {{ Session::get('message') }}
                        </div>
                    @elseif (!empty(Session::get('exception')))
                        <div class="alert alert-warning alert-dismissible" id="notification_box">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-warning"></i> {{ Session::get('exception') }}
                        </div>
                    @endif
                </div>
                <!-- /.Notification Box -->
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">SL#</th>
                            <th width="20%">Name</th>
                             <th width="10%">Point</th>
                             <th width="20%">Status</th>
                            
                            
                            <th width="13%" class="text-center">Added</th>
                           
                            <th width="12%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($sl = 1)
                        @foreach($recruitments as $recruitment)

                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $recruitment['first_name'] }}{{ $recruitment['last_name'] }}</td>
                            <td>{{ $recruitment['point'] }}</td>
                            <td>{{ $recruitment['status'] }}</td>
                           


                            <td class="text-center">{{ date("d F Y", strtotime($recruitment['created_at'])) }}</td>
                           
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                     
                                        <li><a href="{{ url('/setting/recruitments/edit/' . $recruitment['id']) }}"><i class="icon fa fa-edit"></i> Edit</a></li>
                                        <li><a href="{{ url('/setting/recruitments/delete/' . $recruitment['id']) }}" onclick="return confirm('Are you sure to delete this ?');"><i class="icon fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
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