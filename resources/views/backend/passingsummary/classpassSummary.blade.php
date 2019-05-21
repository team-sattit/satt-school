{{--isset($errors) ? dd($errors->first('class_id')) : ''--}}
<!-- Master page  -->
@extends('backend.layouts.master')

<!-- Page title -->
@section('pageTitle') Passing Summary @endsection
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
            Passing Summary
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{URL::route('user.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

            <li class="active">Passing Summary</li>
        </ol>
    </section>
    <!-- ./Section header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
            <div class="box col-md-12">
        <div class="box-inner">
                    <form role="form" id="gradesheet" action="{{ route('passing_postsummary') }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="session">session</label>
                                        <div class="form-group has-feedback">
                                                {!! Form::select('academic_year_id', $academic_years, $acYear , ['placeholder' => 'Pick a year...', 'class' => 'form-control select2', 'required' => 'true']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                <div class="form-group has-feedback">
                                         {!! Form::select('class_id', $classes, $class_id , ['placeholder' => 'Pick a class...', 'id' => 'class_change', 'class' => 'form-control select2', 'required' => 'true']) !!}
                                 </div>
                                </div>
                                <div class="col-md-3">
                                   <div class="form-group has-feedback">
                                         {!! Form::select('section_id', $sections, $section_id , ['placeholder' => 'Pick a section...','class' => 'form-control select2', 'required' => 'true']) !!}
                                    </div>
                                </div>
                    

                                <div class="col-md-3">
                                <div class="form-group has-feedback">
                                                {!! Form::select('subject_id', $subjects, $subject_id , ['placeholder' => 'Pick a subject...','class' => 'form-control select2', 'required' => 'true']) !!}
                                            </div>
                                </div>

                                    <div class="col-md-3">
                                            <div class="form-group has-feedback">
                                                {!! Form::select('exam_id', $exams, $exam_id , ['placeholder' => 'Pick a exam...','class' => 'form-control select2', 'required' => 'true']) !!}
                                            </div>
                                        </div>


                            </div>
                        </div>

                      <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary pull-right"  type="submit"><i class="glyphicon glyphicon-th"></i>Get Sheet</button>

                            </div>
                        </div>
                    </form>

                      @if($result)
                        <div class="row">
                            <div class="col-md-12">
                                <table id="listDataTableWithSearch" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Regi No</th>
                                        <th>Roll No</th>
                                        <th>Name</th>
                                        <th>Class</th>
                                        <th>Shift</th>
                                        <th>Mark</th>
                                        <th>Grade</th>
                                        <th>Point</th>
                                        <th>Merit</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($result as $key=> $student)
                                        <tr>
                                            <td>{{$student->student->regi_no}}</td>
                                            <td>{{$student->student->roll_no}}</td>
                                            <td>{{$student->student->student->name}} </td>
                                            <td>{{$student->class->name}}</td>
                                            <td>{{$student->student->shift}}</td>
                                            <td>{{$student->total_marks}}</td>
                                              <td>{{$student->grade}}</td>
                                              <td>{{$student->point}}</td>
                                              <td>{{$key+1}}</td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <table class="table">
                                <tr style="background: #aee">
                                    <td colspan="5" style="text-align: right;">Total Pass:</td>
                                    <td>{{$result->count()}} Student</td>
                                </tr>
                            </table>
                        </div>
                    @endif
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
             window.changeExportColumnIndex = 6;
             window.excludeFilterComlumns = [0,6,7];
            Academic.sectionInit();
        });
    </script>
    <script>
    	$("#gradesheet").validate({
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
@endsection
<!-- END PAGE JS-->
