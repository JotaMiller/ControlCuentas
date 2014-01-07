<?php
// src/Cupon/CiudadBundle/DataFixtures/ORM/Ciudades.php namespace
namespace ControlCuentas\ControlBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ControlCuentas\ControlBundle\Entity\Tipocuenta;

class Tipocuentas implements FixtureInterface {
	
	public function load(ObjectManager $manager) {
		$tipocuentas = array( 
			array('num'=>1,'nombre' => 'Cuentas a Plazo', 'descripcion' => 'Cuentas con un numero de cuotas fojas, como por ejemplo pago Créditos, Cuotas, Etc.'),
			array('num'=>2,'nombre' => 'Cuentas Indefinidas', 'descripcion' => 'Cuentas que no tienen fecha de término, como por ejemplo: Cuenta de la Luz, Tv Cable, Gastos Fijos, Etc.'), 
			// ... 
		); 
		
		foreach ($tipocuentas as $tipocuenta) 
		{
			$entidad = new Tipocuenta();
			$entidad->setNombre($tipocuenta['nombre']);
			$entidad->setDescripcion($tipocuenta['descripcion']);
			$entidad->setNum($tipocuenta['num']);
			$manager->persist($entidad);
		}
		$manager->flush ();
	}
}
