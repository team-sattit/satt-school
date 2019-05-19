<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeCollection extends Model
{
		protected $with = ['class','registration','section'];
   protected $fillable = ['billNo','class_id','academic_year_id','regi_no','payableAmount','paidAmount','dueAmount','payDate'];

   public function class () {
		return $this->belongsTo('App\IClass', 'class_id');
	}

	public function registration () {
		return $this->belongsTo('App\Registration','regi_no');
	}

	public function section () {
		return $this->belongsTo('App\Section', 'class_id');
	}
}
