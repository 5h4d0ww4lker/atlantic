
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
         <h5 class="align">List of Employee Awards</h5>

         <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SL#</th>
                            <th>Employee Name</th>
                            <th>Award Category</th>
                            <th>Gift</th>
                            <th>Month</th>
                            <th>Award Details</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @php ($sl = 1)
                        @foreach($employee_awords as $employee_aword)
                        <tr>
                                                                                                <?php
$tmp = \App\User::find($employee_aword['employee_id']);
$category = \App\AwardCategory::find($employee_aword['award_category_id']);

?>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $tmp->name }}</td>
                            <td>{{ $category->award_title }}</td>
                            <td>{{ $employee_aword['gift_item'] }}</td>
                            <td>{{ date("d F Y", strtotime($employee_aword['select_month'])) }}</td>
                            <td>{!! str_limit($employee_aword['description'], 65) !!}</td>
                          
                           
                          
                        </tr>
                      @endforeach

                    </tbody>
                </table>
    </div>
</body>
</html>