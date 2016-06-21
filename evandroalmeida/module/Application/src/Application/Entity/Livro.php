<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Genero;
use Doctrine\Common\Collections\ArrayCollection;

/**
	* @ORM\Entity
	* @ORM\Table(name="Livros")
**/
class Livro
{
	/**
		* @ORM\Id
		* @ORM\GeneratedValue(strategy="AUTO")
		* @ORM\Column(type="integer")
	**/
	protected $id;
	
	/** @ORM\Column(type="string", length=100) **/
	protected $titulo;
	
	/**
		* @ORM\ManyToOne(targetEntity="Genero", inversedBy="livros")
		* @ORM\JoinColumn(name="genero_id", referencedColumnName="id")
	**/
	protected $genero;
	
	/**
		* @ORM\ManyToMany(targetEntity="Autor", inversedBy="livros")
		* @ORM\JoinTable(name="livros_possuem_autores")
	**/
	protected $autores;
	
	//Construtor
	public function __construct()
	{
		$this->autores = new ArrayCollection();
	}
	
	//Getters e Setters
	
	public function AddAutor(Autor $autor)
	{
		if(!$this->autores->contains($autor)) {
			$this->autores->add($autor);
			$autor->addLivro($this);
		}
		return $this;
	}
	
	public function removeAutor($autor)
	{
		if ($this->autores->contains($autor)) {
			$this->autores->removeElement($autor);
			$autor->removeLivro($this);
		}
		return $this;		
	}
	
	public function setGenero($genero)
	{
		if($genero === NULL) {
			if($this->genero !== NULL) {
				$this->genero->removeLivro($this);
			}
			$this->genero = NULL;
		} else {
			if($this->genero !==NULL) {
				$this->genero->removeLivro($this);
			}
			$this->genero = $genero;
			$this->genero->addLivro($this);
		}
	}
	
	public function __get($name)
	{
		if(method_exists($this, 'get'.ucfirst($name))) {
			$method = 'get'.ucfirst($name);
			return $this->$method();
		}
		return $this->$name;
	}
	
	public function __set($name, $value)
	{
		if(method_exists($this, 'set'.ucfirst($name))) {
			$method = 'get'.ucfirst($name);
			$this->$method($value);
			return $this;
		}
		$this->$name = $value;
		return $this;
	}
}