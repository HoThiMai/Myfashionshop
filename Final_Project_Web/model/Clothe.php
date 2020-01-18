<?php
require_once "IClothe.php";
abstract class Clothe implements IClothe{
	public $id;
	public $name;
	protected $price;
	public $color;
	protected $image;

	public function __construct($id, $name, $price, $color, $image) {
		$this->id = $id;
    	$this->name = $name;
    	$this->price = $price;
    	$this->color = $color;
    	$this->image = $image;
  	}
}
?>