{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') promotion @endsection
@section('extraStyle')
 <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet">
 @endsection
<!-- End block -->

<!-- Page body extra class -->
@section('bodyCssClass')

 @endsection
<!-- End block -->

<!-- BEGIN PAGE CONTENT-->
@section('pageContent')
    <!-- Section header -->
    <section class="content-header">
      <h1>
            Student Promotion
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Promotion</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <section class="content">
      <div class="box col-md-12">
        <div class="box-inner">
           <div class="box-header" data-original-title="" style="background: #3C8DBC;color: #fff">
                  <h2><i class="glyphicon glyphicon-edit"></i> Promotion From</h2>

            </div>
            <div class="box-content">
         <form role="form" action="/promotion" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box col-md-6">
                                    <div class="box-inner">
                                   
                                        <div class="box-content">
                                            <div class="row">
                                                <div class="col-md-12">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label" for="class">Class</label>

                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                                    <select id="class" name="class" class="form-control select2" >
                                                        <option value="">Select Class</option>
                                                        @foreach($classes as $class)
                                                            <option value="{{$class->id}}">{{$class->name}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label" for="section">Section</label>

                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                                <select id="section" name="section"  class="form-control select2" >
                                                    <option value="">Select Section</option>
                                                   @foreach($sections as $section)
                                                        <option value="{{$section->id}}">{{$section->name}}</option>
                                                  @endforeach

                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="shift">Shift</label>

                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                            <select id="shift" name="shift"  class="form-control select2" >
                                                <option value="">Select Shift</option>
                                                <option value="Day">Day</option>
                                                <option value="Morning">Morning</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <label for="session">session</label>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                            <select id="session" name="session"  class="form-control select2" >
                                                    <option value="">Select Session</option>
                                                   @foreach($academic_years as $academic_year)
                                                            <option value="{{$academic_year->id}}">{{$academic_year->title}}</option>
                                                  @endforeach

                                                </select>
                                        
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="box col-md-6">
            <div class="box-inner">
                <div class="box-header" data-original-title="" style="background: #3C8DBC;color: #fff">
                    <h2><i class="glyphicon glyphicon-edit"></i> Promotion To</h2>


                </div>
                <div class="box-content">

                    <div class="row">
                        <div class="col-md-12">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="class">Class</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-home blue"></i></span>
                                        <select id="class" name="nclass" class="form-control" >
                                            @foreach($classes as $class)
                                                <option value="{{$class->id}}">{{$class->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="section">Section</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                        <select id="section" name="nsection"  class="form-control" >
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                            <option value="F">F</option>
                                            <option value="G">G</option>
                                            <option value="H">H</option>
                                            <option value="I">I</option>
                                            <option value="J">J</option>

                                        </select>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="shift">Shift</label>

                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign blue"></i></span>
                                        <select id="shift" name="nshift"  class="form-control" >
                                            <option value="Day">Day</option>
                                            <option value="Morning">Morning</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="session">session</label>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i> </span>
                                        <input type="text" id="nsession" required="true" class="form-control datepicker" name="nsession"   data-date-format="yyyy">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="studentList" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="allcheck" name="allcheck"> SL#</th>
                        <th>Registration No</th>
                        <th>Roll No</th>
                        <th>Name</th>
                        <th>New Roll No</th>
                    </tr>
                    </thead>
                    <tbody>


                    <tbody>
                </table>
            </div>
        </div>

    </div>

    <!--button save -->
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary pull-right" id="btnsave" type="submit"><i class="glyphicon glyphicon-plus"></i>Save</button>
</form>





        </div>
    </div>
</div>
    </section>
    <!-- /.content -->
@endsection
<!-- END PAGE CONTENT-->

<!-- BEGIN PAGE JS-->
@section('extraScript')
 <script src="{{asset('js/toastr.min.js')}}"></script>
 <script type="text/javascript">
        $(document).ready(function () {
            Academic.iclassInit();
        });
    </script>
    <script>
    	$("#feesetup").validate({
            errorElement: "em",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block");
                error.insertAfter(element);

            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".form-group>div").addClass("has-error").removeClass("has-success");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".form-group>div").addClass("has-success").removeClass("has-error");
            }
        });
    </script>

    <script>
        
          $( document ).on('change','#session',function(){
             var aclass = $('#class').val();
              var section =  $('#section').val();
              var shift = $('#shift').val();
              var session = $('#session').val().trim();
                           $.ajax({
                  url: '/student/getList/'+aclass+'/'+section+'/'+shift+'/'+session,
                  data: {
                      format: 'json'
                  },
                   error: function(error) {
                        alert(error);
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);

                        $("#studentList").find("tr:gt(0)").remove();
                        if(data.length>0)
                        {
                            $('#btnsave').show();
                        }
                        for(var i =0;i < data.length;i++)
                        {
                            addRow(data[i],i);
                        }

                    },
                  type: 'GET'
              });
            });

              $('#allcheck').change(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);

        });



        function addRow(data,index) {
            var table = document.getElementById('studentList');
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
             var cell1 = row.insertCell(0);
            var chkbox = document.createElement("input");
             chkbox.type = "checkbox";
            chkbox.name="promot["+data['regi_no']+"]";
            chkbox.class="checkMe";
            cell1.appendChild(chkbox);

            var cell2 = row.insertCell(1);
            var regiNo = document.createElement("label");

            regiNo.innerHTML=data['regi_no'];
            cell2.appendChild(regi_no);
            var hdregi = document.createElement("input");
            hdregi.name="regi_no[]";
            hdregi.value=data['regi_no'];
            hdregi.type="hidden";
            cell2.appendChild(hdregi);


            var cell3 = row.insertCell(2);
            var rollno = document.createElement("label");
            rollno.innerHTML=data['roll_no'];
            cell3.appendChild(rollno);
            /*   var hdroll = document.createElement("input");
             hdroll.name="rollNo[]";
             hdroll.value=data['rollNo'];
             hdroll.type="hidden";
             cell3.appendChild(hdroll);*/



            var cell4 = row.insertCell(3);
            var name = document.createElement("label");
            name.innerHTML=data['student']['name'];
            cell4.appendChild(name);



            var cell5 = row.insertCell(4);
            var nrollno = document.createElement("input");
            nrollno.type = "text";
            nrollno.name="newrollNo["+data['regi_no']+"]";
            nrollno.size="3";
            cell5.appendChild(nrollno);
        };     
    </script>
@endsection
<!-- END PAGE JS-->
