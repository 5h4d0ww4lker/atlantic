<div id="mainMenu">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('public/index.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Atlantic HRMS</p>
         
        </div>
      </div>
    <ul class="sidebar-menu" data-widget="tree">
        <!--<li class="header">&nbsp;</li>-->
        <li><a href="{{ url('/dashboard')}}"><i class="fa fa-dashboard text-green"></i> <span>Dashboard</span></a></li>
        @permission('hrm-setting')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-cog text-green"></i> <span>Setting</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <!-- <li><a href="#"><i class="fa fa-circle-o"></i> General Setting</a></li>-->
               <!--  <li><a href="{{ url('/setting/client-types') }}"><i class="fa fa-circle-o"></i> Manage Client Types</a></li> -->
                <li><a href="{{ url('/setting/branchs') }}"><i class="fa fa-circle-o"></i> Manage Branches</a></li>
                <li><a href="{{ url('/setting/departments') }}"><i class="fa fa-circle-o"></i> Manage Departments</a></li>
                <li><a href="{{ url('/setting/designations') }}"><i class="fa fa-circle-o"></i> Manage Designations</a></li>
                <li><a href="{{ url('/setting/leave_categories') }}"><i class="fa fa-circle-o"></i> Manage Leave Categories</a></li>
                <li><a href="{{ url('/setting/working-days') }}"><i class="fa fa-circle-o"></i> Set Working Day</a></li>
                <li><a href="{{ url('/setting/holidays') }}"><i class="fa fa-circle-o"></i> Holiday List</a></li>
                <li><a href="{{ url('/setting/personal-events') }}"><i class="fa fa-circle-o"></i> Personal Event</a></li>
                <li><a href="{{ url('/setting/award_categories') }}"><i class="fa fa-circle-o"></i> Manage Award Categories</a></li>
                 <li><a href="{{ url('/setting/bonus_categories') }}"><i class="fa fa-circle-o"></i> Manage Bonus Categories</a></li>
                  <li><a href="{{ url('/setting/properties') }}"><i class="fa fa-circle-o"></i> Manage Properties</a></li>
                  <li><a href="{{ url('/setting/property_requests') }}"><i class="fa fa-circle-o"></i> Manage Propety Requests</a></li>
                    <li><a href="{{ url('/setting/trainings') }}"><i class="fa fa-circle-o"></i> Manage Trainings</a></li>
                     <li><a href="{{ url('/setting/recruitments') }}"><i class="fa fa-circle-o"></i> Manage Recruitments</a></li>
                @permission('role')
                <li><a href="{{ route('setting.role.index') }}"><i class="fa fa-circle-o"></i>Role</a></li>
                @endpermission
            </ul>
        </li>
        @endpermission

        @permission('people')
       <!--  <li class="treeview">
            <a href="#">
                <i class="fa fa-user text-green"></i> <span>People</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu"> -->
                @permission('manage-employee')
               <!--  <li><a href="{{ url('/people/employees') }}"><i class="fa fa-circle-o"></i> Manage Employee</a></li> -->
                @endpermission
                @permission('manage-clients')
               <!--  <li><a href="{{ url('/people/clients') }}"><i class="fa fa-circle-o"></i> Manage Clients</a></li> -->
                @endpermission
                @permission('manage-references')
               <!--  <li><a href="{{ url('/people/references') }}"><i class="fa fa-circle-o"></i> Manage References</a></li> -->
                @endpermission
          <!--   </ul>
        </li> -->
        @endpermission

        @permission('file-upload')
        <li><a href="{{ url('/folders')}}"><i class="fa fa-cloud-upload text-green"></i> <span>File Upload</span></a></li>
        @endpermission


        @permission('sms')
        <li><a href="{{ url('/sms')}}"><i class="fa fa-envelope text-green"></i> <span>Mail</span></a></li>
        @endpermission

        <li class="header">HRM</li>
        @permission('people')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-user text-green"></i> <span>Employees</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
             <ul class="treeview-menu">
                @permission('manage-employee')
                <li><a href="{{ url('/people/employees') }}"><i class="fa fa-circle-o"></i> Manage Employees</a></li>
                @endpermission
                 @permission('manage-employee')
                <li><a href="{{ url('/people/dependents') }}"><i class="fa fa-circle-o"></i> Manage Dependents</a></li>
                @endpermission
                @permission('manage-clients')
               <!--  <li><a href="{{ url('/people/clients') }}"><i class="fa fa-circle-o"></i> Manage Clients</a></li> -->
                @endpermission
                @permission('manage-references')
                <li><a href="{{ url('/people/references') }}"><i class="fa fa-circle-o"></i> Manage References</a></li>
                @endpermission
                 @permission('manage-references')
             <!--    <li><a href="{{ url('/people/employees/reports') }}"><i class="fa fa-circle-o"></i> Employee Reports</a></li> -->
                @endpermission
            </ul>
        </li>    
        @endpermission
        @permission('payroll-management')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-dollar text-green"></i> <span>Payroll Management</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                @permission('manage-salary')
                <li><a href="{{ url('/hrm/payroll') }}"><i class="fa fa-circle-o"></i> Manage Salary</a></li>
                @endpermission

                @permission('salary-list')
                <li><a href="{{ url('/hrm/payroll/salary-list') }}"><i class="fa fa-circle-o"></i> Salary List</a></li>
                @endpermission

                @permission('make-payment')
                <li><a href="{{ url('/hrm/salary-payments') }}"><i class="fa fa-circle-o"></i> Make Payment</a></li>
                @endpermission

                @permission('generate-payslip')
                <li><a href="{{ url('/hrm/generate-payslips/') }}"><i class="fa fa-circle-o"></i> Generate Payslip</a></li>
                @endpermission

                @permission('manage-bonus')
                <li><a href="{{ url('/hrm/bonuses') }}"><i class="fa fa-circle-o"></i> Manage Bonus</a></li>
                @endpermission

                @permission('manage-deduction')
                <li><a href="{{ url('/hrm/deductions') }}"><i class="fa fa-circle-o"></i> Manage Deduction</a></li>
                @endpermission

                @permission('loan-management')
                <li><a href="{{ url('/hrm/loans') }}"><i class="fa fa-circle-o"></i> Loan Management</a></li>
                @endpermission

                @permission('provident-fund')
                <li><a href="{{ url('/hrm/provident-funds') }}"><i class="fa fa-circle-o"></i> Provident Fund</a></li>
                @endpermission
            </ul>
        </li>
        @endpermission

        @permission('attendance-management')
        <li class="treeview">
            <a href="#">
                <i class="fa fa-calendar text-green"></i> <span>Attendance Management</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
             

                 @permission('manage-attendance')
                <li><a href="{{ url('/hrm/attendance/daily') }}"><i class="fa fa-circle-o"></i> Manage Attendance</a></li>
                @endpermission

                @permission('manage-attendance')
                <li><a href="{{ url('/hrm/attendance/check_in_check_out') }}"><i class="fa fa-circle-o"></i> Check In/Out</a></li>
                @endpermission

               <!--  @permission('attendance-report')
                <li><a href="{{ url('/hrm/attendance/report') }}"><i class="fa fa-circle-o"></i> Attendance Report</a></li>
                @endpermission -->
            </ul>
        </li>
        @endpermission

        @permission('manage-award')
        <li><a href="{{ url('/hrm/employee-awards') }}"><i class="fa fa-trophy text-green"></i> <span>Manage Award</span></a></li>
        @endpermission

        @permission('manage-expense')
      <!--   <li><a href="{{ url('/hrm/expence/manage-expence') }}"><i class="fa fa-money text-green"></i> <span>Manage Daily Accounts</span></a></li>
  -->       @endpermission

        @permission('leave-application')
        <li class="treeview">
            <a href="#">
                <i class="glyphicon glyphicon-send text-green"></i> <span>Leave Application</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                @permission('manage-leave-application')
                <li><a href="{{ url('/hrm/application_lists') }}"><i class="fa fa-circle-o"></i> <span>Manage Leave Application</span></a></li>
                @endpermission

               @permission('leave-reports')
                <li><a href="{{ url('/hrm/leave_application') }}"><i class="fa fa-circle-o"></i> <span>My Leave Application</span></a></li>
                @endpermission
                @permission('leave-reports')
                <li><a href="{{ url('/hrm/leave-reports') }}"><i class="fa fa-circle-o"></i> <span>Leave Reports</span></a></li>
                @endpermission
            </ul>
        </li>
        @endpermission

        @permission('notice')
        <li class="treeview">
            <a href="#">
                <i class="glyphicon glyphicon-bell text-green"></i> <span>Notice</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                @permission('manage-notice')
                <li><a href="{{ url('/hrm/notice') }}"><i class="fa fa-circle-o"></i>Manage Notice</a></li>
                @endpermission

                @permission('notice-board')
                <li><a href="{{url('/hrm/notice/show')}}"><i class="glyphicon glyphicon-bell"></i> <span>Notice Board</span></a></li>
                @endpermission
            </ul>
        </li>
        @endpermission

         @permission('notice')
        <li class="treeview">
            <a href="#">
                <i class="glyphicon glyphicon-bell text-green"></i> <span>Reports</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                @permission('manage-employee')
                <li><a href="{{ url('/people/employees2') }}"><i class="fa fa-circle-o"></i> Manage Employees</a></li>
                @endpermission

                @permission('salary-list')
                <li><a href="{{ url('/hrm/payroll/salary-list2') }}"><i class="fa fa-circle-o"></i> Salary List</a></li>
                @endpermission
                 @permission('generate-payslip')
                <li><a href="{{ url('/hrm/generate-payslips/') }}"><i class="fa fa-circle-o"></i> Generate Payslip</a></li>
                @endpermission

                 @permission('loan-management')
                <li><a href="{{ url('/hrm/loans2') }}"><i class="fa fa-circle-o"></i> Loan Management</a></li>
                @endpermission

                @permission('manage-bonus')
                <li><a href="{{ url('/hrm/bonuses2') }}"><i class="fa fa-circle-o"></i> Manage Bonus</a></li>
                @endpermission
                 @permission('manage-attendance')
                <li><a href="{{ url('/hrm/attendance/daily') }}"><i class="fa fa-circle-o"></i> Manage Attendance</a></li>
                @endpermission
                 @permission('manage-award')
        <li><a href="{{ url('/hrm/employee-awards') }}"><i class="fa fa-circle-o"></i> <span>Manage Award</span></a></li>
        @endpermission
                  @permission('manage-leave-application')
                <li><a href="{{ url('/hrm/application_lists2') }}"><i class="fa fa-circle-o"></i> <span>Manage Leave Application</span></a></li>
                @endpermission

            </ul>
        </li>
        @endpermission

        <li class="header">PROFILE SETTING</li>
        <li><a href="{{ url('/profile/user-profile') }}"><i class="fa fa-user text-green"></i> <span>Profile</span></a></li>
        <li><a href="{{ url('/profile/change-password') }}"><i class="fa fa-key text-green"></i> <span>Change Password</span></a></li>
    
    </ul>
</div>