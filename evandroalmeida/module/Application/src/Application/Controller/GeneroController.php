<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Genero;

class GeneroController extends AbstractActionController
{
	protected $entityManager;
	
	public function getEntityManager()
	{
		if (!$this->entityManager) {
			$this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		}
		return $this->entityManager;
	}
	
	public function indexAction()
	{
		$generos = $this->getEntityManager()->getRepository('\Application\Entity\Genero')->findAll();
		return new ViewModel(array('generos' => $generos));
	}
}