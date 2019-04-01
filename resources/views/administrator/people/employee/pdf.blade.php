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
<body>
  
    <div class="footer"><p style="font-size: 14px;">Page: <span class="pagenum"></span></p></div>
    <div class="container">
        <table width="100%">
            <tr>
                <td>
                    <p style="padding-top: 12px; font-weight: bold;">
                        {{ $employee->name }}
                        <br>
                        {{ $employee->employee_id }}
                        <br>
                        {{ $employee->designation }}
                    </p>
                </td>
              
            </tr>
        </table>
        <br>
        <table width="100%">
            <tbody>
                <tr>
                    <td>Father's Name</td>
                    <td>{{ $employee->father_name }}</td>
                </tr>
                <tr>
                    <td>Mother's Name</td>
                    <td>{{ $employee->mother_name }}</td>
                </tr>
                <tr>
                    <td>Spouse Name</td>
                    <td>{{ $employee->spouse_name }}</td>
                </tr>
                <tr>
                    <td>Present Address</td>
                    <td>{{ $employee->present_address }}</td>
                </tr>
                <tr>
                    <td>Permanent Address</td>
                    <td>{{ $employee->permanent_address }}</td>
                </tr>
               
                <tr>
                    <td>Email</td>
                    <td>{{ $employee->email }}</td>
                </tr>
               
                <tr>
                    <td>Contact No</td>
                    <td>{{ $employee->contact_no_one }}</td>
                </tr>
                <tr>
                    <td>Emergency Contact</td>
                    <td>{{ $employee->emergency_contact }}</td>
                </tr>
               
             
                <tr>
                    <td>Date of Birth</td>
                    <td>
                        @if($employee->date_of_birth != NULL)
                        {{ date("d F Y", strtotime($employee->date_of_birth)) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Academic Qualification</td>
                    <td>{!! $employee->academic_qualification !!}</td>
                </tr>
                <tr>
                    <td>Profession Qualification</td>
                    <td>{!! $employee->professional_qualification !!}</td>
                </tr>
                
                <tr>
                    <td>Experience</td>
                    <td>{!! $employee->experience !!}</td>
                </tr>
                <tr>
                    <td>Reference</td>
                    <td>{!! $employee->reference !!}</td>
                </tr>
                <tr>
                    <td>Joining Date</td>
                    <td>{{ date("D d F Y", strtotime($employee->joining_date)) }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>