@extends('administrator.master')
@section('title', 'Super Admin  details')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            SUPER ADMIN
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>People</a></li>
            <li><a href="{{ url('/people/super_admins') }}">Super Admin</a></li>
            <li class="active">Details</li>
        </ol>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Super Admin  details</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <a href="{{ url('/people/super_admins') }}" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i> Back</a>
            <hr>
            <div id="printable_area">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <p style="padding-top: 40px; font-weight: small;">
                                <b>Full Name: </b>{{ $super_admin->name }} &nbsp; {{$super_admin->father_name}}&nbsp;{{$super_admin->grand_father_name}}
                                <br>
                                <b>Employee ID:</b> {{ $super_admin->employee_id }}
                                <br>
                                

                                <br>
                                
                               
                            </p>
                        </td>
                        <td width="17%">
                            @if(!empty($super_admin->profile_picture))
                            <img src="{{ url('public/profile_picture/' . $super_admin->profile_picture) }}"  width="100%">
                            @else
                            <img src="{{ url('public/profile_picture/blank_profile_picture.png') }}" alt="blank_profile_picture" class="img-responsive img-thumbnail" width="160px">
                            @endif

                            
                        </td>

                       
                    </tr>
                </table>
                <hr>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>First Name</td>
                            <td>{{ $super_admin->name }}</td>
                        </tr>
                        <tr>
                            <td>Father's Name</td>
                            <td>{{ $super_admin->father_name }}</td>
                        </tr>
                      <tr>
                            <td>Grand Father's Name</td>
                            <td>{{ $super_admin->grand_father_name }}</td>
                        </tr>
                       
                      
                        <tr>
                            <td>Email</td>
                            <td>{{ $super_admin->email }}</td>
                        </tr>
                       
                        <tr>
                            <td>Contact No</td>
                            <td>{{ $super_admin->contact_no_one }}</td>
                        </tr>
                        
                        <tr>
                            <td>Gender</td>
                            <td>
                                @if($super_admin->gender == 'm')
                                <p>Male</p>
                                @else
                                <p>Female</p>
                                @endif
                            </td>
                        </tr>
                       
                       
                        
                        <tr>
                            <td>Created By</td>
                            <td>{{ $created_by->name }}</td>
                        </tr>
                        <tr>
                            <td>Date Added</td>
                            <td>{{ date("D d F Y - h:ia", strtotime($super_admin->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td>Last Updated</td>
                            <td>{{ date("D d F Y - h:ia", strtotime($super_admin->updated_at)) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Start Button -->
            <div class="btn-group btn-group-justified">
                @if ($super_admin->activation_status == 1)
                <div class="btn-group">
                    <a href="{{ url('/people/super_admins/deactive/' . $super_admin->id)}}" class="tip btn btn-success btn-flat" data-toggle="tooltip" data-original-title="Click to deactive">
                        <i class="fa fa-arrow-down"></i>
                        <span class="hidden-sm hidden-xs"> Active</span>
                    </a>
                </div>
                @else
                <div class="btn-group">
                    <a href="{{ url('/people/super_admins/active/' . $super_admin->id)}}" class="tip btn btn-warning btn-flat" data-toggle="tooltip" data-original-title="Click to active">
                        <i class="fa fa-arrow-up"></i>
                        <span class="hidden-sm hidden-xs"> Deactive</span>
                    </a>
                </div>
                @endif
                <div class="btn-group">
                    <button type="button" class="tip btn btn-primary btn-flat" title="Print" data-original-title="Label Printer" onclick="printDiv('printable_area')">
                        <i class="fa fa-print"></i>
                        <span class="hidden-sm hidden-xs"> Print</span>
                    </button>
                </div>
               <!--  <div class="btn-group">
                    <a href="{{ url('/people/super_admins/download-pdf/' . $super_admin->id) }}" class="tip btn btn-primary btn-flat" title="" data-original-title="PDF">
                        <i class="fa fa-file-pdf-o"></i>
                        <span class="hidden-sm hidden-xs"> PDF</span>
                    </a>
                </div> -->
                <div class="btn-group">
                    <a href="{{ url('/people/super_admins/edit/' . $super_admin->id) }}" class="tip btn btn-warning tip btn-flat" title="" data-original-title="Edit Product">
                        <i class="fa fa-edit"></i>
                        <span class="hidden-sm hidden-xs"> Edit</span>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{ url('/people/super_admins/delete/' . $super_admin->id) }}" class="tip btn btn-danger btn-flat" data-toggle="tooltip" data-original-title="Click to delete" onclick="return confirm('Are you sure to delete this ?');">
                        <i class="fa fa-arrow-up"></i>
                        <span class="hidden-sm hidden-xs"> Delete</span>
                    </a>
                </div>
            </div>
            <!-- /.End Button -->
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
</div>
@endsection