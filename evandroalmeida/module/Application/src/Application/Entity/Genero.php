<?php  
namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
  * @ORM\Entity 
  * @ORM\Table(name="Generos")
**/
class Genero
{
	/**
	  * @ORM\Id
	  * @ORM\Column(type="integer")
	  * @ORM\GeneratedValue(strategy="AUTO")
	**/
	protected $id;
	
	/**
	 * @ORM\Column(type="string")
	**/
	protected $descricao;
	
	/**
	 * @ORM\ManyToMany(targetEntity="Livro", mappedBy="generos")
	**/
	protected $livros;
	
}