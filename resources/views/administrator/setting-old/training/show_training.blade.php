@extends('administrator.master')
@section('title', 'Trainings')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            DEPARTMENT
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>Setting</a></li>
            <li><a href="{{ url('/setting/trainings') }}">Trainings</a></li>
            <li class="active">Details</li>
        </ol>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Details of training</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <a href="{{ url('/setting/trainings') }}" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> Back</a>
                <hr>
                <table id="example1" class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td width="25%">Title</td>
                            <td width="75%">{{ $training->title }}</td>
                        </tr>
                        <tr>
                            <td>Venue</td>
                            <td>{!! $training->venue !!}</td>
                        </tr>
                         <tr>
                            <td>From Date</td>
                            <td>{{ date("d F Y", strtotime($training['from_date'])) }}</td>
                        </tr>
                         <tr>
                            <td>To Date</td>
                            <td>{{ date("d F Y", strtotime($training['to_date'])) }}</td>
                        </tr>
                        <tr>
                            <td>Create By</td>
                            <td>{{ $training->name }}</td>
                        </tr>
                        <tr>
                            <td>Date Added</td>
                            <td>{{ date("D d F Y h:ia", strtotime($training->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td>Last Updated</td>
                            <td>{{ date("D d F Y h:ia", strtotime($training->updated_at)) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                {{$training->description}}
                            </td>
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