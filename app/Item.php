<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
	protected $fillable = ['name', 'description', 'price', 'stock'];
	protected $table = 'items';
}
