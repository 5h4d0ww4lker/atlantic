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
         <h1>Atlantic HRM - List of Salary</h1>

         <table id="example1" class="table table-bordered table-striped">
                    <thead>
                       <tr>
                            <th>SL#</th>
                            <th>Employee Name</th>
                            <th>Employee Type</th>
                            <th>Gross Salary</th>
                            <th>Deductions</th>
                            <th>Net Salary</th>
                          
                        </tr>
                    </thead>
                   <tbody>
                        @php ($sl = 1)
                        @foreach($salaries as $salary)
                        <tr>
                                                                            <?php
$tmp = \App\User::find($salary['user_id']);
?>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $tmp->name }}</td>
                           
                            <td>
                                @if($salary['employee_type'] == 1)
                                Provision
                                @elseif($salary['employee_type'] == 2)
                                Permanent
                                @elseif($salary['employee_type'] == 3)
                                Full Time
                                @elseif($salary['employee_type'] == 4)
                                Part Time
                                @else
                                Adhoc
                                @endif
                            </td>
                            <td>
                            @php($gross_salary = $salary['basic_salary'] + $salary['house_rent_allowance'] + $salary['medical_allowance'] + $salary['special_allowance'] + $salary['other_allowance'])
                            {{ $gross_salary }}
                            </td>
                            <td>
                            @php($total_deduction = $salary['tax_deduction'] + $salary['provident_fund_deduction'] + $salary['other_deduction'])
                            {{ $total_deduction }}
                            </td>
                            <td>{{ $gross_salary - $total_deduction }}</td>

                          
                        </tr>
                        @endforeach
                    </tbody>
                </table>
    </div>
</body>
</html>