<?php 
namespace App\Classes;
class Modal {
	public function __construct($fields,$modalHeader,$modalName,$btnId) {
		$this->btnId=$btnId;
		$this->modalName=$modalName;
		$this->modalHeader=$modalHeader;
		$this->modalFields=$fields;
	}
	public function Deploy() {
		echo view('modal')->with('Modal',$this)->render();
	}
}
?>