@extends('administrator.master')
@section('title', 'Team')

@section('main_content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            DPENDENTS
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>People</a></li>
            <li class="active">Team</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Manage Dependents</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <a href="{{ url('/people/dependents/create') }}" class="btn btn-primary btn-flat"><i class="fa fa-plus"></i> Add </a>
               
               
               
                <!-- Notification Box -->
            </div>
             <hr>
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
            <?php
                $tag = 0;
             ?>
                       
                      @foreach ($dependents as $user_id => $dependents)

                                <?php
$employee = \App\User::find($user_id);
?>
                     
<?php
                      $tag++; ?>

            <div class="box-body">
              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$tag}}">
                       {{$employee->first_name}} {{$employee->father_name}}
                      </a>
                    </h4>
                  </div>

                   <table id="example" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          
                            
                            <th width="">Dependent Name</th>
                            <th width="">Relationship</th>
                            <th width="">Phone Number</th>
                            <th width="" class="text-center">Added</th>
                           
                            <th width="" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                  @foreach ($dependents as $dependent)
                  <div id="collapse{{$tag}}" class="panel-collapse collapse in">
                    <div class="box-body">
                         <tr>
                            
                            <td>{{  $dependent->dependent_name }}</td>
                            <td>{{ $dependent->relationship }}</td>
                            <td>{{ $dependent->phone_number }}</td>
                            <td class="text-center">{{ date("d F Y", strtotime($dependent->created_at)) }}</td>
                           
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary btn-xs btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                       
                                        <li><a href="{{ url('/people/dependents/edit/' . $dependent->id) }}"><i class="icon fa fa-edit"></i> Edit</a></li>
                                        <li><a href="{{ url('/people/dependents/delete/' . $dependent->id) }}" onclick="return confirm('Are you sure to delete this ?');"><i class="icon fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </div>
                  </div>
                  @endforeach
                  </tbody>
                </table>
                </div>
               
               
              </div>
            </div>
        



                        
                        @endforeach
       
              </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

@endsection