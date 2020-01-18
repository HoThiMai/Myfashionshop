<?php
require_once "Clothe.php";
class Shirt extends Clothe {

	function getType(){
  		return "Shirt clothe";
  	}
	
	function getImagePath(){
      return "../".$this->image;
  }

  	function getDisplayPrice(){
  		if($this->color == "yellow"){
  			return ($this->price * 80 / 100)." VND "." (-20%) ";
  		}
		return $this->price." VND";
	}

	function getDisplayOldPrice(){
		if($this->color == "white"){
          return $this->price." VND";
    }
    return "";
  }
}

?>