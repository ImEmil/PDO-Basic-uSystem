<?php
class Sessions{

	public function c_session () {
		return(isset($_SESSION['loggedin'])) ? true : false;
	}
	
	public function loggedIn() {
		if ($this->c_session() === true) {
			return true;
			}
			else {
				return false;
			}
		}
	 
	public function loggedOut() {
		if ($this->c_session() === false) {
			return true;
			}
			else {
				return false;
			}
		}
	}
