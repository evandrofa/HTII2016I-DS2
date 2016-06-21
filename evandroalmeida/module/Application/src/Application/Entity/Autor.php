<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
	* @ORM\Entity
	* @ORM\Table(name="autores")
**/
class Autor
{
	/**
		* @ORM\Id
		* @ORM\GeneratedValue(strategy="AUTO")
		* @ORM\Column(type="integer")
	**/
		protected $id;
		
		/** @ORM\Column(type="string", length=100) **/
		protected $nome;
		
		/** @ORM\ManyToMany(targetEntity="Livro", mappedBy="autores") **/
		protected $livros;
		
		//Construtor
		public function __construct()
		{
			$this->livros = new ArrayCollection();
		}
		
		//Getters e Setters
		public function addLivro(Livro $livro)
		{
			if (!$this->livros->contains($livro)){
				$this->livros->add($livro);
			}
			return $this;
		}
		
		public function removeLivro($livro)
		{
			if ($this->livros->contains($livro)){
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