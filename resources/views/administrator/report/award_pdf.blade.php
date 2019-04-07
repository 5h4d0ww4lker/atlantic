<?phpheader('Content-Type: text/html; charset=UTF-8'); ?>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style type="text/css">
body {font-family: 'Tera-Regular'}
</style>
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
   /* container {
        page-break-after: always
    }*/
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
    color: #280ce9;
   
      }  

      .centeralign{
    text-align: center;
     color: #280ce9;
   
      }  

      .rightalign{
    text-align: right;
     color: #280ce9;


   
      }  
       .footer3{
   position: fixed; bottom: 15px;
    color: #280ce9;
    }  

       .footer4{
   position: fixed; bottom: 25px;
    color: #280ce9;
    font-size: bold;
    }   
    .footer5{
   position: fixed; bottom: 27px;
    color: #280ce9;
    font-size: bold;
    } 
  
    .header4{
   position: fixed; top: 107px;
    color: #280ce9;
    font-weight: bolder;
    }   
    .header5{
   position: fixed; top: 106px;
    color: #280ce9;
    font-size: bold;
    } 
 .header6{
   position: fixed; bottom: 105px;
    color: #280ce9;
    font-size: bold;
    } 

    .header8{
    position: fixed; top: 110px;
    color: #280ce9;
    font-size: bold;
    } 
    

     .footer6{
   position: fixed; bottom: 22px;
    color: #280ce9;
    font-size: bold;
    }   
     
   .footer2{
   position: fixed; bottom: 2px;
    color: #280ce9;
    }   

.column {
  float: left;
  width: 33.33%;
  color: #280ce9;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
</style>

</head>
<body style="background-color:#ffffff;font-family: Tera-Regular;">
  
    <div class="footer"><p style="font-size: 14px;">Page: <span class="pagenum"></span></p></div>
    <div class="container">

     
  

  <div class="row">
  <div class="column"><p> <h5>Dawladda Deegaanka Soomaalida</h5></p><p><h5>Xafiska Horumarinta Khayraadka</h5></p><p><h5>Biyaha</h5></p></div>
  <?php $first = htmlentities("የሱማሌ ክልል መንግስት") ?>
  <?php $second = htmlentities("የውሃ ሃብት ልማት ቢሮ") ?>
   <div class="column">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{ public_path("public/som2.png") }}" alt="" style="width: 50px; height: 50px; text-align:center;">
    <p class="centeralign"> <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Somali Regional State</h5></p><p> <h5>Water Resource Development Bureau</h5></p></div>
  <div class="column"><img src="{{ public_path("public/som3.png") }}" alt="" style="width: 200px; height: 50px; text-align:center;"></div>

</div> 

      
      <hr class="header8">
       <hr class="header5">
       <hr class="header4">

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
   <hr class="footer4">
<hr class="footer5">
<hr class="footer6">
                 <p>  <h5 class="footer3">027753303/2017&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0257755838 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0257755857&nbsp;&nbsp; 0257755836&nbsp;&nbsp; FAX:0257752017&nbsp;&nbsp; POBOX: 207&nbsp;&nbsp;   Water is life   </h5>
        </p>

         <p>  <h5 class="footer2">Bureau Head&nbsp;&nbsp;&nbsp;&nbsp;Depurty Bureau Head&nbsp;&nbsp;   P.R.S.P FL Support process &nbsp;&nbsp;Email:srswaterbiro@hotmail.com&nbsp;&nbsp; <img src="{{ public_path("public/som4.png") }}" alt="" style="width: 50px; height: 20px; top:15px; text-align:center;">      </h5>
        </p>
    </div>
</body>
</html>