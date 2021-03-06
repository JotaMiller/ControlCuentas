<?php

namespace ControlCuentas\ControlBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CuentaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CuentaRepository extends EntityRepository
{
	/**
	 * Devuelve las estadisticas asociadas a la cuenta
	 * 
	 * 1) cuotas pagadas
	 * 2) cuotas pendientes
	 * 3) total pagado $$
	 * 4) total pendiente $$
	 * 
	 * @param $int $id_cuenta: Id de la cuenta a buscar
	 * 
	 * @return array
	 */
    public function getEstadisticas($id){
    	$em = $this->getEntityManager();
    	$estadisticas = array(
    			'cuotas_pagadas'=>0,
    			'total_pagado' => 0
    	);
    	$cuotas_pagadas = 0;
    	$cuotas_pendientes = 0;
    	$total_pagado = 0;
    	$total_pendiente = 0;
    	
    	$cuotas = $em->createQueryBuilder()
	    	->select('cuota')
	    	->from('ControlBundle:Cuota', 'cuota')
	    	->where('cuota.cuenta = :id')
	    	->orderBy('cuota.fecha_vencimiento','ASC')
	    	->setParameters(array('id'=>$id))
	    	->getQuery()
	    	->getResult();
    	
    	foreach ($cuotas as $cuota){
    		if ($cuota->getMontoPagado()) {
    			$cuotas_pagadas ++;
    			$total_pagado  = $total_pagado + $cuota->getMontoPagado();
    		}else{
    			$total_pendiente = $total_pendiente + $cuota->getMontoPactado();
    			$cuotas_pendientes ++;
    		}
    	}
    	
    	$total_cuotas = count($cuotas);
    	
    	$estadisticas['cuotas_pagadas'] = $cuotas_pagadas;
    	$estadisticas['cuotas_pendientes'] = $cuotas_pendientes;
    	$estadisticas['total_pagado'] = $total_pagado;
    	$estadisticas['total_pendiente'] = $total_pendiente;
    	
    	return $estadisticas;
    }
}
