<?php

namespace GlaivePro\Drafterer;

use Illuminate\Database\Eloquent\Relations\MorphMany;

use GlaivePro\Drafterer\Drafterer;
use GlaivePro\Drafterer\Draft;

trait Draftable
{
	private $draftererStorage;
	
	public function draftererDrafts(): MorphMany
	{
        return $this->morphMany(Draft::class, 'subject');
	}
	
	public function getDraftererAttribute(): Drafterer
	{
		if ($this->draftererStorage)
			return $this->draftererStorage;
		
		return $this->draftererStorage = new Drafterer($this);
	}
}
