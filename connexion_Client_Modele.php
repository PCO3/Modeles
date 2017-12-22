<?php
class Connexion_Client_Modele extends CI_Model
{
	//fonction pour la connexion client
	public function userLogin($pseudo, $password)
	{
		return $this->db->select('NomClient')
						->from('clientzodiac')
						->where('NomClient', $pseudo)
						->where('Password', $password)
						->limit(1)
						->get()
						->result();
	}
	

	public function setPassword($oldPassword, $newPassword, $pseudo)
	{
		$this->db->where('NomClient', $pseudo)
				 ->where('password', $oldPassword)
				 ->from('clientzodiac')
				 ->update('password', $newPassword);
		return 'Mot de passe changé avec succès';
	}

		
	public function insertClient($pseudo, $Password, $email) //insérer client
	{
		$dbName= 'clientzodiac';
		$data= array(
				'NomClient' => $pseudo,
				'Password' => $Password,
				'email' => $email
		);
		$this->db->insert($dbName,$data);
		$message='Client inséré';
		return $message;
	}


	public function deleteClient($id)
	{
		$this->db->where('identifiant',$id);
		$this->db->delete('clientzodiac');
		$message='Client supprimé';
		return $message;
	}

	//fonction pour récuperer les identifiants de tous les clients sous forme de tableaux

	public function allId()
	{
		$ids = $this->db->select('NomClient')
						->from('clientzodiac')
						->get()
						->result();

		//on recupere tous les ids sous forme de stdClass pour les mettre en string dans un tableau
		foreach ($ids as $id ) {

			$Id=(array) $id;
			$tabIds[]=$Id['NomClient'];
			
		}
		//on récupere le tableau d'ids
		return $tabIds;

	}

	//fonction pour récuperer les email de tous les clients

	public function allEmail()
	{
		$emails = $this->db->select('email')
						   ->from('clientzodiac')
						   ->get()
						   ->result();

		//on recupere tous les emails sous forme de stdClass pour les mettre en string dans un tableau
		foreach ($emails as $email ) {

			$Email=(array) $email;
			$tabEmail[]=$Email['email'];
			
		}
		//on récupere le tableau d'emails
		return $tabEmail;

	}

	public function uniqueId($newId, $tabId)
	{
		$unique = TRUE;
		$tabIds = $tabId;
		for($i=0; $i<count($tabIds); ++$i){
			if($tabIds[$i]==$newId){
				$unique=FALSE;
			}
		}
		return $unique;
	}

	public function uniqueEmail($newEmail, $tabEmail)
	{
		$unique = TRUE;
		$tabEmails = $tabEmail;
		for($i=0; $i<count($tabEmails); ++$i){
			if($tabEmails[$i]==$newEmail){
				$unique=FALSE;
			}
		}
		return $unique;
	}

	
	public function affichageclients() //afficher les clients
	{
		return $liste = $this->db->get('clientzodiac');
	}

	public function rechercheClients($champs) //afficher les clients
	{
		$dbName='clientzodiac';
		$liste = $this->db->from('clientzodiac')
						  ->like('NomClient', $champs)
				 		  ->or_like('email', $champs)
						  ->get();
		return $liste;
	}

}
?>