<?php
require_once "Clothe.php";
class SportClothe extends Clothe {

	function getType(){
		return "Sport Clothe";
	}
  function getImagePath(){
      return "../".$this->image;
  }
  function getDisplayPrice(){
    if($this->color == "red"){
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
