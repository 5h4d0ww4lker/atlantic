@extends('administrator.master')
@section('title', 'Update Attendance')

@section('main_content')
<style type="text/css">
body {
    background: black;
}

.clock {
    position: relative;
    top: 50px;
    left: 50%;
    transform: translateX(-50%) translateY(-50%);
    color: green;
    font-size: 40px;
    font-family: Orbitron;
    letter-spacing: 3px;


}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            ATTENDANCE
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a>HRM</a></li>
            <li class="active">Update Attendance</li>
        </ol>
    </section>

   <!-- Main content -->
    <!-- <section class="content col-md-3">
    </section>   -->
    <section class="content col-md-12">

       <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Check In / Out</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                 <div class="col-md-12">
                @if (!empty(Session::get('message')))
                <div class="alert alert-success alert-dismissible" id="notification_box">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fa fa-check"></i> {{ Session::get('message') }}
                </div>
                @elseif (!empty(Session::get('error')))
                <div class="alert alert-danger alert-dismissible" id="notification_box">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="icon fa fa-danger"></i> {{ Session::get('error') }}
                </div>
                @endif
            </div>
              <div class="row">
                <div class="col-md-4">
                  <div id="MyClockDisplay" class="clock"></div>
                  <!-- ./chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-8">
                    <div class="col-md-6">
                        <ul class="chart-legend clearfix">
                     <form action="{{ url('/hrm/attendance/first_check_in') }}"  method="post">
                          {{ csrf_field() }}
                   <button type="submit" class="btn btn-block btn-success btn-md"><i class=" fa-arrow-circle-down"></i>First Check In</button>
               </form>
                <form action="{{ url('/hrm/attendance/first_check_out') }}"  method="post">
                      {{ csrf_field() }}
                   <button type="submit" class="btn btn-block btn-warning btn-md" style="margin-top:20px";>First Check Out</button>
                    </form>
                     </div>  
                     
                      <div class="col-md-6">
                         <form action="{{ url('/hrm/attendance/second_check_in') }}"  method="post">
                          {{ csrf_field() }}
                     <button type="submit" class="btn btn-block btn-success btn-md">Second Check In</button>
 </form>
                      <form action="{{ url('/hrm/attendance/second_check_out') }}"  method="post">
                          {{ csrf_field() }}
                    <button type="submit" class="btn btn-block btn-warning btn-md" style="margin-top:20px;margin-bottom:20px;">Second Check Out</button>
                     </form>
                     </div>   
                  
                   
                  
                  </ul>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
           
        
      <!-- /.row -->
      <!-- END CUSTOM TABS -->
    </div>

    </section>
    <!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){

    });

    function showTime(){
    var date = new Date();
    var h = date.getHours(); // 0 - 23
    var m = date.getMinutes(); // 0 - 59
    var s = date.getSeconds(); // 0 - 59
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyClockDisplay").textContent = time;
    
    setTimeout(showTime, 1000);
    
}

showTime();
</script>
@endsection