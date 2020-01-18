<?php
require_once "Clothe.php";
class Dress extends Clothe {

	function getType(){
		return "Dress";
	}

	function getImagePath(){
  		return "../".$this->image;
  }

  function getDisplayPrice(){
    if($this->color == "pink"){
        return ($this->price * 140 / 100)." VND "." (+40%) ";
    }
     return $this->price." VND";
  }

  function getDisplayOldPrice(){
     if($this->color == "black"){
        return $this->price." VND";
     }
     return "";
  }
}
?>