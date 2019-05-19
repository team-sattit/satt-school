<?php

namespace App\Http\Controllers\Backend;

use App\IClass;
use App\Section;
use App\AcademicYear;
use App\Book;
use App\bookStock;
use App\Issuebook;
use App\Registration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Redirect;
use Validator;
use DB;
use Brian2694\Toastr\Facades\Toastr;

class LibraryController extends Controller
{
    

   public function getsearch()
{
	$classes = IClass::all();
	$books =array();
	return View::Make('backend.library.booksearch',compact('classes','books'));
}

public function postsearch()
{
	if(Input::get('code')!="" || Input::get('title')!="" || Input::get('author') !="")
	{
		$query=Book::leftJoin('i_classes', function($join) {
			$join->on('books.class', '=', 'i_classes.id');

		})
		->join('book_stocks','books.code', '=', 'book_stocks.code')
		->select('books.id', 'books.code', 'books.title', 'books.author','book_stocks.quantity','books.rackNo','books.rowNo','books.type','books.desc',DB::raw("IFNULL			(i_classes.name,'All') as class"));
		if(Input::get('code')!="") $query->where('books.code','=',Input::get('code'));
		if(Input::get('title')!="")$query->orWhere('books.title','LIKE','%'.Input::get('title').'%');
		if(Input::get('author') !="")$query->orWhere('books.author','LIKE','%'.Input::get('author').'%');


		$books=$query->get();


		$classes =IClass::select('name','id');
		return View::Make('backend.library.booksearch',compact('books','classes'));

	}
	else {
        Toastr::warning('Please Fill up atlest one field:','Warning');
		return Redirect::to('/library/search');

	}
}

public function postsearch2()
{
	$rules=[
		'type' => 'required',
		'class' => 'required',


	];
	$validator = \Validator::make(Input::all(), $rules);
	if ($validator->fails())
	{
		return Redirect::to('/library/search')->withErrors($validator);
	}
	else {
		if(Input::get('class')=="All"){

			$books=Book::leftJoin('i_classes', function($join) {
			$join->on('books.class', '=', 'i_classes.id');
			})
			->join('book_stocks','books.code', '=', 'book_stocks.code')
			->select('books.id', 'books.code', 'books.title', 'books.author','book_stocks.quantity','books.rackNo','books.rowNo','books.type','books.desc','i_classes.name as class')
			->where('books.type',Input::get('type'))
			->get();

		}
		else {

			$books=Book::leftJoin('i_classes', function($join) {
			$join->on('books.class', '=', 'i_classes.id');
			})
			->join('book_stocks','books.code', '=', 'book_stocks.code')
			->select('books.id', 'books.code', 'books.title', 'books.author','book_stocks.quantity','books.rackNo','books.rowNo','books.type','books.desc','i_classes.name as class')
			->where('books.class',Input::get('class'))
			->where('books.type',Input::get('type'))->get();
		}
		$classes = IClass::select('name','id');
		return View::Make('backend.library.booksearch',compact('books','classes'));

	}
}

public function getissueBookview()
{

	return View::Make('backend.library.bookissueview');
}

public function postissueBookview()
{

	if(Input::get('status')!="")
	{
		$books = Issuebook::select('*')
		->Where('Status','=',Input::get('status'))
		->get();
		return View::Make('backend.library.bookissueview',compact('books'));
	}
	if(Input::get('regiNo')!="" || Input::get('code') !="" || Input::get('issueDate') !="" || Input::get('returnDate') !="")
	{

		$books = Issuebook::select('*')->where('regiNo','=',Input::get('regiNo'))
		->orWhere('code','=',Input::get('code'))
		->orWhere('issueDate','=',$this->parseAppDate(Input::get('issueDate')))
		->orWhere('returnDate','=',$this->parseAppDate(Input::get('returnDate')))

		->get();
		return View::Make('backend.library.bookissueview',compact('books'));

	}
	else {
        
        Toastr::warning('Pleae fill up at least one feild!:','Warning');

		return Redirect::to('/library/issuebookview');

	}

}

public function getissueBookupdate($id)
{
	$book= Issuebook::find($id);
	 Toastr::success('Status Update Successfully!:','Success');
	return View::Make('backend.library.bookissueedit',compact('book'));
}

public function getissueBook()
	{
		
         $students = Registration::with('student')
            ->get();
		$books = Book::all();
		return View::Make('backend.library.bookissue',compact('students','books'));
	}



	public function checkBookAvailability($code,$quantity)
{
	$availabeQuantity=DB::table('book_stocks')
	->select('quantity')
	->where('code',$code)->first();
	$result = "Yes";
	if($quantity>$availabeQuantity->quantity)
	$result = "No";
	return ["isAvailable" => $result ];
	

}


	public function postissueBook()
	{

		$rules=[
			'regiNo' => 'required',
			'bookCode' => 'required',
			'quantity' => 'required',
			'issueDate' => 'required',
			'returnDate' => 'required',

		];
		$validator = \Validator::make(Input::all(), $rules);
		if ($validator->fails())
		{
			return Redirect::to('/library/issuebook')->withErrors($validator)->withInput();
		}
		else {


			/*$availabeQuantity=DB::table('bookStock')->select('quantity')->where('code',Input::get('code'))->first();

			if(Input::get('quantity')>$availabeQuantity->quantity)
			{
			$errorMessages = new Illuminate\Support\MessageBag;
			$errorMessages->add('deplicate', 'This book quantity not availabe right now!');
			return Redirect::to('/library/issuebook')->withErrors($errorMessages)->withInput();

		}*/
		$data=Input::all();
		$issueData = [];
		$now=\Carbon\Carbon::now();
		foreach ($data['bookCode'] as $key => $value){
			$issueData[] = [
				'regiNo' => $data['regiNo'],
				'issueDate' => $this->parseAppDate($data['issueDate']),
				'code' => $value,
				'quantity' => $data['quantity'][$key],
				'returnDate' => $this->parseAppDate($data['returnDate'][$key]),
				'fine' => $data['fine'][$key],
				'created_at' => $now,
				'updated_at' => $now,
			];

		}
		Issuebook::insert($issueData);
		/*  $issuebook = new Issuebook();
		$issuebook->code = Input::get('code');
		$issuebook->quantity = Input::get('quantity');
		$issuebook->regiNo = Input::get('regiNo');
		$issuebook->issueDate = $this->parseAppDate(Input::get('issueDate'));
		$issuebook->returnDate = $this->parseAppDate(Input::get('returnDate'));
		$issuebook->fine = Input::get('fine');
		$issuebook->save();*/
		Toastr::success('Succesfully book borrowed for:','Success');
		return Redirect::to('/library/issuebook');

	}

}
}
