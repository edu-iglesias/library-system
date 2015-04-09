<?php
		
class Category extends Eloquent{
	
	public $timestamps = false;
	 
	protected $table = 'category';

	protected $primaryKey = 'categoryID';

}