<?php
namespace ControlCuentas\ControlBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ControlCuentas\ControlBundle\Entity\Categoria;
use ControlCuentas\ControlBundle\Entity\Usuario;

class Categorias extends AbstractFixture implements OrderedFixtureInterface, FixtureInterface,ContainerAwareInterface {
	
	/**
	 * @var ContainerInterface
	 */
	private $container;
	
	/**
	 * {@inheritDoc}
	 */
	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}
	
	public function getOrder()
	{
		return 2;
	}
	
	public function load(ObjectManager $manager) {
		$categorias = array( 
			array('nombre' => 'Universidad', 'descripcion' => 'Cuentas asociadas a la Universidad, como son el pago de mensualidad, gastos en libros, etc.'),
			array('nombre' => 'Créditos', 'descripcion' => 'Cuentas de Créditos, Prestamos, etc.'), 
			// ... 
		); 
		
		$userManager = $this->container->get('fos_user.user_manager');
		$admin = $userManager->findUserByUsername('admin');
		$usuario = new Usuario();
		
		
		foreach ($categorias as $categoria) 
		{
			$entidad = new Categoria();
			$entidad->setNombre($categoria['nombre']);
			$entidad->setDescripcion($categoria['descripcion']);
			$entidad->setUsuario($admin);
			
			$manager->persist($entidad);
		}
		$manager->flush ();
	}
}
