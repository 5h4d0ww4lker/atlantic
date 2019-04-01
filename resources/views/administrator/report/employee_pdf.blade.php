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
   .align{
    text-align: center;
    border-top-style: ridge;
    border-bottom-style: ridge;
    background-color: #ffffff; 
      }

   .leftalign{
    text-align: left;
   
      }  

      .rightalign{
    text-align: right;
   
      }     
</style>

</head>
<body style="background-color:#ffffff";>
  
    <div class="footer"><p style="font-size: 14px;">Page: <span class="pagenum"></span></p></div>
    <div class="container">

        <div>
       <p>  <h5 class="leftalign">Somali Regional State Construction Office&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Ref No:__________________</h5></h5>
        </p>
        <p>  <h5 class="leftalign">Tel: 2511787878</h5>
        </p>
        <p>  <h5 class="leftalign">P.O.Box: 4533</h5>
        </p>
      </div>
         <h5 class="align">List of Employees</h5>

         <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="">SL#</th>
                            <th width="">ID</th>
                            <th width="">Name</th>
                            <th width="">Designation</th>
                            <th width="">Contact No</th>
                            <th width="" class="text-center">Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        {{ $sl = 1 }}
                        @foreach($employees as $employee)

                                                <?php
$tmp = \App\Designation::find($employee['designation_id']);
?>

                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $employee['employee_id'] }}</td>
                            <td>{{ $employee['name'] }}</td>
                            <td>{{ $tmp->designation }}</td>
                            <td>{{ $employee['contact_no_one'] }}</td>
                           <td>{{ $employee['employement_status'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
</body>
</html>