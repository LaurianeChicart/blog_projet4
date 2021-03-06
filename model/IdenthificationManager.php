<?php
/**
 * 
 * Code skeleton generated by dia-uml2php5 plugin
 * written by KDO kdo@zpmag.com
 * @see        Manager
 */
require_once('model/Manager.php');

class IdenthificationManager extends Manager 
{

	/**
	 * 
	 * @var 
	 * @access private
	 */
	private  $_db;


	/**
	 * Connexion à la base de données
	 * @access public
	 * @param PDO $db 
	 * @return void
	 */

	public function __construct() 
	{
		$this->_db = $this->dbConnect();
	}


	/**
	 * Récupérer le mot de passe correspondant au nom
	 * @access public
	 * @param int $id 
	 * @return Post
	 */

	public function getPassword($name)
	{
		$req = $this->_db->prepare('SELECT password FROM user WHERE username = :username');
		$req->execute(array('username' => $name));
		$password = $req->fetch()['password'];

		return $password;
	}

}