<?php

class Import_Txt_Modele extends CI_Model
{

public function insertof($tableau) //insérer of
	{
		$dbName= 'of';
		$this->db->insert($dbName,$tableau);
		$message='Of inséré';
		return $message;
	}	
}



?>