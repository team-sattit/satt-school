<?php

namespace App\Http\Controllers\Backend;

use App\IClass;
use App\Section;
use App\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Redirect;
use Validator;
use DB;
use App\Http\Helpers\AppHelper;
use Brian2694\Toastr\Facades\Toastr;

class PromotionController extends Controller
{
    public function index()
	{
		$classes = IClass::all();
		$sections =Section::all();
		$academic_years =AcademicYear::all();

		return View::Make('backend.promotion.promotion',compact('classes','sections','academic_years'));
	}
}
