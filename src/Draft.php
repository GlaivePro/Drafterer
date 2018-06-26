<?php

namespace GlaivePro\FutureVersion;

use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
	protected $table = 'drafterer';
	
	protected $fillable = ['attribute', 'value'];
}
