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
         <h1>Atlantic HRM - List of Notices</h1>

         <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                            <th>SL#</th>
                            <th width="20%">Title</th>
                            <th width="80%">Detail</th>
                            >
                           
                        </tr>
                    </thead>
                    <tbody>
                        @php ($sl = 1)
                        @foreach($notices as $notice)
                        <tr>
                       <td>{{ $sl++ }}</td>
                            <td>{{ $notice->notice_title }}</td>
                           
                            <td>{{ $notice['description'] }}</td>
                           
                           
                           
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
</body>
</html>