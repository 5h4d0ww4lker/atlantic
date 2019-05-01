@extends('administrator.master')
@section('title', 'Dashboard')

@section('main_content')
<style type="text/css">
.modal-title {
  font-weight: bold;
}
.bg-grey{
  background-color: #BDBDBD;
}
.users-list>li {
  width: 10%;
}
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  @php($user = Auth::user())
  @if($user->access_label == 1)
  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->

    <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
         <h3>{{ count($employees) }}</h3>

            <p>Employees</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="{{ url('/people/employees') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
         <h3>{{ count($designations) }}</h3>

          <p>Designations</p>
        </div>
        <div class="icon">
          <i class="fa fa-envelope"></i>
        </div>
        <a href="{{ url('/setting/designations') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-orange">
        <div class="inner">
          <h3>{{ count($notices) }}</h3>

            <p>Notices</p>
        </div>
        <div class="icon">
          <i class="fa fa-file"></i>
        </div>
        <a href="{{ url('/hrm/notice') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{ count($files) }}</h3>

            <p>Files</p>
        </div>
        <div class="icon">
          <i class="fa fa-image"></i>
        </div>
        <a href="{{ url('/folders') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>


  <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua">
              <i class="ion ion-ios-list-outline"><a href="{{ url('/setting/departments') }}" ><h6 style="color:#FFFFFF">More info<i class="fa fa-arrow-circle-right"></i></h6> </a></i></span>

            <div class="info-box-content">

              <span class="info-box-text">Departments</span>

              <span class="info-box-number">{{ count($departments) }}</span>
            </div>
            

            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->

        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-grid-view"><a href="{{ url('/setting/branchs') }}" ><h6 style="color:#FFFFFF">More info<i class="fa fa-arrow-circle-right"></i></h6> </a></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Branches</span>
              <span class="info-box-number">{{ count($branches) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-person"><a href="{{ url('/hrm/application_lists') }}" ><h6 style="color:#FFFFFF">More info<i class="fa fa-arrow-circle-right"></i></h6> </a></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Leave Requests</span>
              <span class="info-box-number">{{ count($leave_requests) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       

         <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-briefcase"><a href="{{ url('/hrm/employee-awards') }}" ><h6 style="color:#FFFFFF">More info<i class="fa fa-arrow-circle-right"></i></h6> </a></i></span>

       
            <div class="info-box-content">
              <span class="info-box-text">Awards</span>
              <span class="info-box-number">{{ count($awards) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->


      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-8 connectedSortable">
     
          <!-- Chat box -->
          <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-comments-o"></i>

              <h3 class="box-title">Notice  Board</h3>

             
            </div>
            <div class="box-body chat" id="chat-box">
              <!-- chat item -->
               @foreach($notices as $notice)
              <div class="item">
                <img src="{{ asset('public/index.png') }}" alt="user image" class="online">

                <p class="message">
                  <a href="{{ url('/hrm/notice') }}" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i>  {{$notice->created_at}}</small>
                    {!! $notice->notice_title !!}
                                     
                </p>
                 <span class="pull-left" style="padding-left: 5px;">&nbsp;{!! $notice->description !!}</span>     </a>
            
              </div>

               @endforeach
              <!-- /.item -->
            
              <!-- /.item -->
              <!-- chat item -->
          
              <!-- /.item -->
            </div>
            <!-- /.chat -->
          
          </div>
          <!-- /.box (chat box) -->

    

     


        </section>

              <div class="col-md-4">
          <!-- Info Boxes Style 2 -->
         
          <!-- /.info-box -->
          
          <!-- /.info-box -->
       
       <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-calendar"><a href="{{ url('/setting/holidays') }}" ><h6 style="color:#FFFFFF">More info<i class="fa fa-arrow-circle-right"></i></h6> </a></i></span>

       
            <div class="info-box-content">
              <span class="info-box-text">Holidays</span>
              <span class="info-box-number">{{ count($holidays) }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>



                <div class="box box-success">
            <div class="box-header">
              <i class="fa fa-comments-o"></i>

              <h3 class="box-title">Upcoming Birthdays</h3>

             
            </div>
            <div class="box-body chat" id="chat-box">
              <!-- chat item -->

            <?php
$employees = \App\User::where('deletion_status', 0)->get();
?>

          
               @foreach($employees as $employee)

               <?php

                $birthday = $employee->date_of_birth;

          

if (date('m', strtotime($birthday)) == date('m')) { ?>
    
<?php

$today = date('d');
$bd = date('d', strtotime($birthday));
$nbDays =$bd - $today;

if ($nbDays > 0 && $nbDays <= 5) {

 $con = date('d', strtotime($birthday)) - date('d');
 $message = $employee->name."'s birthday is in ". $nbDays." days"; 


}

if ($nbDays == 0){
  $message = "Today is". $employee->name."'s Birthday.";
}
 ?>
              @if(isset($message))
               <div class="item">
                <img src="{{ asset('public/index.png') }}" alt="user image" class="online">
                <p class="message">
                  <a href="#" class="name">
                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i></small>
                    Birthday Alert
                  </a>

                 {{$message}}
                </p>
                </div>
                @endif
                  

                
               
              

              <?php }?>

            

               @endforeach
              <!-- /.item -->
            
              <!-- /.item -->
              <!-- chat item -->
          
              <!-- /.item -->
            </div>
            <!-- /.chat -->
          
          </div>
          <!-- /.info-box -->
         
          <!-- /.info-box -->
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->

      </div>
      <!-- /.row (main row) -->
    @if(count($personal_events)>0)
    <div class="box box-danger">
      <div class="box-header">
        <h3 class="box-title">Events</h3>

        <div class="box-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

            <div class="input-group-btn">
              <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive no-padding">
        <table class="table table-hover">
          <tr>
            <th>SL#</th>
            <th>Event Name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Created By</th>
          </tr>
          @php($sl = 1)
          @foreach($personal_events as $personal_event)
          <tr>
            <td>{{ $sl++ }}</td>
            <td><span class="label label-primary">{{ $personal_event->personal_event }}</span></td>
            <td><span class="label label-warning">{{ date("d F Y", strtotime($personal_event->start_date)) }}</span></td>
            <td><span class="label label-warning">{{ date("d F Y", strtotime($personal_event->end_date)) }}</span></td>
            <td>{{ $personal_event->name }}</td>
          </tr>
          @endforeach
        </table>
      </div>
      <!-- /.box-body -->


    </div>
    <!-- /.box -->
    @endif

  </section>



   <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Employees Male / Female</div>

              
                {!!$charts->html() !!}
            </div>
        </div>
         <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">New Employees by Month</div>

              
                {!!$charts2->html() !!}
            </div>
        </div>
 </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Employees per Department</div>

              
                {!!$charts3->html() !!}
            </div>
        </div>

          <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">Upcoming Holidays</div>

              
                {!! $calendar_details->calendar() !!}
            </div>
        </div>

       
        
        </div>

      
 </div>
  <!-- /.content -->
  @endif

{!! Charts::scripts() !!}
{!! $charts->script() !!}
{!! $charts2->script() !!}
{!! $charts3->script() !!}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
 
 
<!-- Scripts -->
<script src="http://code.jquery.com/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
 
{!! $calendar_details->script() !!}
@endsection