<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonusCategory extends Model
{
    protected $fillable = [
        'created_by', 'bonus_category', 'publication_status', 'bonus_category_description'
    ];

    
	 public function name(){
	return $this->bonus_category;
}
}
