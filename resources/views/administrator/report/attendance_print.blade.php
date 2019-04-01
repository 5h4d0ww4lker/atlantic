<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Details</title>

    <style type="text/css">
    table {
        border-collapse: collapse
    }
    table, th, td {
        border: 1px solid black
    }
    td {
        padding: 3px 15px; font-size: 16px
    }
    container {
        page-break-after: always
    }
    .header {
        position: fixed; top: 0px; margin: 100px 0px
    }
    .footer {
        position: fixed; bottom: 0px
    }
    .pagenum:before {content: counter(page);}
    @page {
       size: 21cm 29.7cm;
       margin-top: 1.27cm;
       margin-left: 1.27cm;
       margin-right: 1.27cm;
   }
</style>

</head>
<body onload="window.print();" style="padding: 0px; margin: 0px">
  
    <div class="footer"><p style="font-size: 14px;">Page: <span class="pagenum"></span></p></div>
    <div class="container">
         <h1>Atlantic HRM - Attendance Report</h1>

         <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>First Check In</th>
                            <th>First Check Out</th>
                            <th>Second Check In</th>
                            <th>Second Check Out</th>
                            <!-- <th>Created at</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @php ($sl = 1)
                    @foreach($attendances as $attendance)


                                                                                                <?php
$tmp = \App\User::find($attendance->created_by);
?>
                      <tr>
                        <td>{{  $sl++ }}</td>
                        <td>{{ $tmp->name}}</td>
                        <td>{{ date('d/m/Y', strtotime($attendance->created_at)) }}</td>
                       
                        <td class="text-center">
                        @if($attendance->leave_category_id != null)
                        <a href="" class="btn btn-info btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Pending"><i class="icon fa fa-hourglass-2"></i> On Leave</a>
                        @elseif($attendance->first_check_in == "On Time")
                          <a href="" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Accepted"><i class="icon fa fa-smile-o">{{$attendance->first_check_in}}- On Time</i></a>
                        @else
                          <a href="" class="btn btn-danger btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Not Accepted"><i class="icon fa fa-clock"></i>{{$attendance->first_check_in}} - Late Arrival</a>
                        @endif
                      </td>

                       <td class="text-center">
                        @if($attendance->leave_category_id != null)
                        <a href="" class="btn btn-info btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Pending"><i class="icon fa fa-hourglass-2"></i> On Leave</a>
                        @elseif($attendance->first_check_out == 'On Time')
                          <a href="" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Accepted"><i class="icon fa fa-smile-o">{{$attendance->first_check_out}}- On Time</i></a>
                        @else
                          <a href="" class="btn btn-danger btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Not Accepted"><i class="icon fa fa-clock"></i>{{$attendance->first_check_out }}- Early Departure</a>
                        @endif
                      </td>

                        <td class="text-center">
                        @if($attendance->leave_category_id != null)
                        <a href="" class="btn btn-info btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Pending"><i class="icon fa fa-hourglass-2"></i> On Leave</a>
                        @elseif($attendance->second_check_in == 'On Time')
                          <a href="" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Accepted"><i class="icon fa fa-smile-o">{{$attendance->second_check_in}}- On Time</i></a>
                        @else
                          <a href="" class="btn btn-danger btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Not Accepted"><i class="icon fa fa-clock"></i>{{$attendance->second_check_in}} - Late Arrival</a>
                        @endif
                      </td>

                       <td class="text-center">
                        @if($attendance->leave_category_id != null)
                        <a href="" class="btn btn-info btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Pending"><i class="icon fa fa-hourglass-2"></i> On Leave</a>
                        @elseif($attendance->second_check_out == 'On Time')
                          <a href="" class="btn btn-success btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Accepted"><i class="icon fa fa-smile-o">{{$attendance->second_check_out}}- On Time</i></a>
                        @else
                          <a href="" class="btn btn-danger btn-xs btn-flat btn-block" data-toggle="tooltip" data-original-title="Not Accepted"><i class="icon fa fa-clock"></i>{{$attendance->second_check_out}}- Early Departure</a>
                        @endif
                      </td>

                       
                @endforeach



            </tbody>
                </table>
    </div>
</body>
</html>