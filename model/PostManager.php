<?php
/**
 * 
 * Code skeleton generated by dia-uml2php5 plugin
 * written by KDO kdo@zpmag.com
 * @see        Manager
 */
require_once('Manager.php');

class PostManager extends Manager 
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
	 * Récupérer un billet
	 * @access public
	 * @param int $id 
	 * @return Post
	 */

	public function getPost($id) 
	{
		$req = $this->_db->prepare('SELECT id, title, content, dateCreation, DATE_FORMAT(dateCreation, "%d/%m/%Y") AS dateCreationFormat, DATE_FORMAT(dateModif, "%d/%m/%Y") AS dateModifFormat, image, alt FROM posts WHERE id = :id');
		$req->execute(array('id' => $id));
		$post = new Post($req->fetch());

		return $post;
	}
	/**
	 * Récupérer la liste des billets publiés pour pagination
	 * @access public
	 * @return array
	 */

	public function getAllPostsList() 
	{
		$posts =[];

		$req = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(dateCreation, "%d/%m/%Y") AS dateCreationFormat, DATE_FORMAT(dateModif, "%d/%m/%Y") AS dateModifFormat, image, alt FROM posts WHERE draft IS NULL ORDER BY dateCreation');
		$req->execute();
		
		while ($datas = $req->fetch())
		{
			$posts[] = new Post($datas);
		}
		
		return $posts;
	}
	/**
	 * Récupérer la liste des billets publiés pour pagination
	 * @access public
	 * @return array
	 */

	public function getPostsList($pagePost) 
	{
		$posts =[];

		$req = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(dateCreation, "%d/%m/%Y") AS dateCreationFormat, DATE_FORMAT(dateModif, "%d/%m/%Y") AS dateModifFormat, image, alt FROM posts WHERE draft IS NULL ORDER BY dateCreation DESC LIMIT ' . ($pagePost - 1) * 5 . ', 5');
		$req->execute();
		
		while ($datas = $req->fetch())
		{
			$posts[] = new Post($datas);
		}
		
		return $posts;
	}


	/**
	 * Récupérer la liste des billets en brouillon
	 * @access public
	 * @return array
	 */

	public function getDraftPostsList() 
	{
		$draftPosts =[];
		
		$req = $this->_db->prepare('SELECT id, title, content, DATE_FORMAT(dateCreation, "%d/%m/%Y") AS dateCreationFormat, DATE_FORMAT(dateModif, "%d/%m/%Y") AS dateModifFormat, image, alt FROM posts WHERE draft = 1 ORDER BY dateCreation DESC');
		$req->execute();
		while($datas = $req->fetch())
		{
			$draftPosts[] = new Post($datas);
		}
		
		return $draftPosts;
	}


	/**
	 * Nombre de billets publiés
	 * @access public
	 * @return int
	 */

	public function countPosts() 
	{
		$req = $this->_db->query('SELECT COUNT(*) AS nbPosts FROM posts WHERE draft IS NULL');
		$nbPosts = $req->fetch()['nbPosts'];
		return $nbPosts;
	}


	/**
	 * Ajouter un nouveau billet à la base de données
	 * @access public
	 * @param Post $post 
	 * @return void
	 */

	public function addAsPost(Post $post) 
	{
		
		$req = $this->_db->prepare('INSERT INTO posts (title, content, dateCreation, dateModif, image, alt, draft) VALUES(:title, :content, NOW(), NULL, :image, :alt, :draft)');
		$req->execute(array(
			'title'   => $post->title(),
			'content' => $post->content(),
			'image'   => $post->image(),
			'alt'	  => $post->alt(),
			'draft'	  => $post->draft()
		));
		

	}

	/**
	 * Mettre à jour un billet edité.
	 * @access public
	 * @param Post $post 
	 * @return void
	 */

	public function updatePost(Post $post) 
	{
		$req = $this->_db->prepare('UPDATE posts SET title = :title, content = :content, dateCreation = :dateCreation, dateModif = NOW(), image = :image, alt = :alt, draft = :draft WHERE id = :id');
		$req->execute(array(
			'title'   		=> $post->title(),
			'content' 		=> $post->content(),
			'dateCreation' 	=> $post->dateCreation(), 
			'image'   		=> $post->image(),
			'alt'	  		=> $post->alt(),
			'draft'	  		=> $post->draft(),
			'id'      		=> $post->id()
			
		));
	}

	
	/**
	 * Publier un brouillon
	 * @access public
	 * @param Post $post 
	 * @return void
	 */

	public function updateDraftToPost(Post $post) 
	{
		$req = $this->_db->prepare('UPDATE posts SET title = :title, content = :content, dateCreation = NOW(), dateModif = NULL, image = :image, alt = :alt, draft = :draft WHERE id = :id');
		$req->execute(array(
			'title'   		=> $post->title(),
			'content' 		=> $post->content(),
			'image'   		=> $post->image(),
			'alt'	  		=> $post->alt(),
			'draft'	  		=> $post->draft(),
			'id'      		=> $post->id()
			
		));
	}

	
	/**
	 * Supprimer un billet
	 * @access public
	 * @param int $id 
	 * @return void
	 */

	public function deletePost($id) 
	{
		$this->_db->exec('DELETE FROM posts WHERE id = '. $id);
	}


}
