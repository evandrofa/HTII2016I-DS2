<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
	* @ORM\Entity
	* @ORM\Table(name="generos")
**/
class Genero
{
	/**
		* @ORM\Id
		* @ORM\GeneratedValue(strategy="AUTO")
		* @ORM\Column(type="integer")
	**/	
	protected $id;
	
	/**
		* @ORM\Column(type="string", length=50, unique=TRUE)
	**/
	protected $descricao;
	/**
		* @ORM\OneToMany(targetEntity="Livro", mappedBy="genero")
	**/	
	protected $livros;
	
	//Construtor
	public function __construct()
	{
		$this-> livros = new ArrayCollection();
	}
	
	//Getters e Setters
	public function addLivro(Livro $livro)
	{
		if(!$this->livros->contains($livro)){
			$this->livros->add($livro);
		}
		return $this;
	}
	public function removeLivro(Livro $livro)
	{
		if($this->livros->contains($livro)){
			$this->livros->removeElement($livro);
		}
		return $this;
	}
	public function __get($name)
	{
		return $this->$name;
	}
	public function __set($name, $value)
	{
		$this->$name = $value;
	}	
}