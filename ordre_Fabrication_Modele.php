<?php

class Ordre_Fabrication_Modele extends CI_Modele
{
	public function rechercheOF($numeroOF)
	{
		$resultat = $this->db->select(*)
							 ->from('ordrefabrication')
							 ->where('NumeroOF', $numeroOF)
							 ->get();

		return $resultat;
	}
	
f