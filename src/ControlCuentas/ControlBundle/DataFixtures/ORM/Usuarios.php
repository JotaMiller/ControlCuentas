<?php 
namespace ControlCuentas\ControlBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use ControlCuentas\ControlBundle\Entity\Usuario;

class Usuarios implements FixtureInterface, ContainerAwareInterface
{
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
	
	public function load(ObjectManager $manager)
	{
		
		$usuarios = array(
				array('username' => 'admin', 
						'password' => 'password',
						'email' => 'admin@controlcuentas.cl',
						'roles' => array('ROLE_ADMIN'),
						'enabled' => true
				)
		);
		
		$userManager = $this->container->get('fos_user.user_manager');
		
		foreach ($usuarios as $usuario) {
			$user = $userManager->createUser();
			
			$user->setPlainPassword($usuario['password']);
			$user->setUsername($usuario['username']);
			$user->setEmail($usuario['email']);
			$user->setRoles($usuario['roles']);
			$user->setEnabled($usuario['enabled']);	
			
			$userManager->updateUser($user);
		}
	}
}