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
      

         <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                            <tr>
                            <th>SL#</th>
                            <th>Employee Name</th>
                            <th>Reason</th>
                            <th>Starts Date</th>
                            <th>End Date</th>
                            <th>Leave category</th>
                            <th>Created at</th>
                            
                        </tr>
                           
                     
                    </thead>
                    <tbody>
                        @php ($sl = 1)
                        @foreach($leave_applications as $leave_application)

                       
                                                                                                <?php
$tmp = \App\User::find($leave_application['created_by']);
$category = \App\LeaveCategory::find($leave_application['leave_category_id']);
?>
                          <tr>
                        <td>{{  $sl++ }}</td>
                        <td>{{ $tmp->name }}</td>
                        <td>{!! str_limit($leave_application['reason'], 65) !!}</td>
                        <td>{{ date('d/m/Y', strtotime($leave_application['start_date'])) }}</td>
                        <td>{{ date('d/m/Y', strtotime($leave_application['end_date'])) }}</td>
                        <td>{{ $category->leave_category}}</td>
                        <td>{{ date("D d F Y h:ia", strtotime($leave_application['created_at'])) }}</td>

                     

                   
                </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
</body>
</html>