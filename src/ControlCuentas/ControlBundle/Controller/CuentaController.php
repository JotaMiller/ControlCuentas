<?php

namespace ControlCuentas\ControlBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ControlCuentas\ControlBundle\Entity\Cuenta;
use ControlCuentas\ControlBundle\Form\CuentaType;
use ControlCuentas\ControlBundle\Entity\Cuota;

/**
 * Cuenta controller.
 *
 */
class CuentaController extends Controller
{

    /**
     * Muestras las cuentas "Activas" para el usuario logeado
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();
        
        $entities = $em->getRepository('ControlBundle:Cuenta')->findBy(array('usuario'=>$usuario->getId(),'activo'=>1));

        return $this->render('ControlBundle:Cuenta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Cuenta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Cuenta();
        $usuario = $this->getUser();
        
        $form = $this->createForm(new CuentaType(), $entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            // Seteo de variables
            // @TODO: Pendiente agregar la selección de los diferentes tipos de Cuentas, de momento solo se admiten cuentas fijas
            $tipocuenta         =   $em->getRepository('ControlBundle:Tipocuenta')->findOneByNum(1);
            
            $numero_cuotas      =   $form->get('cantidadCuotas')->getData();
            $monto_pactado      =   $form->get('montoCuota')->getData();
            $fecha_vencimiento  =   $form->get('fechaPrimeraCuota')->getData();
                                    
//            ld($fecha_vencimiento->add(new \DateInterval('P12M')));
            $entity->setUsuario($usuario);
            $entity->setTipocuenta($tipocuenta);
            $entity->setActivo(1);
            $em->persist($entity);
            
            if ($tipocuenta->getNum() == 1){
                // Cuenta plazo fijo
                for ($i = 1; $i<= $numero_cuotas; $i++) {
                    $cuota = new Cuota();
                    $cuota->setCuenta($entity);
                    $cuota->setMontoPactado($monto_pactado);
                    $cuota->setFechaVencimiento($fecha_vencimiento);
                    
                    $fecha_vencimiento->add(new \DateInterval('P1M')); // +1 mes
                    
                    $em->persist($cuota);
                    $em->flush();
                }
            }else{
                // Cuenta indefinida (Sin limite de 'Cuotas')
                $cuota = new Cuota();
                $cuota->setCuenta($entity);
                $cuota->setMontoPactado($monto_pactado);
                $cuota->setFechaVencimiento($fecha_vencimiento);
                
                //@TODO: en caso de que la cuenta tenga fecha anterior a la actual
                // crear las cuentas necesarias hasta la fecha
                $em->persist($cuota);
                $em->flush();
            }

            $em->flush();

            return $this->redirect($this->generateUrl('cuenta_show', array('slug' => $entity->getSlug())));
        }

        return $this->render('ControlBundle:Cuenta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    

    /**
     * Displays a form to create a new Cuenta entity.
     *
     */
    public function newAction()
    {
        $entity = new Cuenta();
        $form   = $this->createForm(new CuentaType(), $entity);

        return $this->render('ControlBundle:Cuenta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cuenta entity.
     *
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuenta')->findOneBySlug($slug);
        $cuotas = $em->getRepository('ControlBundle:Cuota')->findAllOrdered($entity->getId());
        $estadisticas = $em->getRepository('ControlBundle:Cuenta')->getEstadisticas($entity->getId());
        
        if (!$entity || $entity->getActivo() == 0) {
            throw $this->createNotFoundException('No se encuentra la Cuenta solicitada');
        }

        $deleteForm = $this->createDeleteForm($slug);

        return $this->render('ControlBundle:Cuenta:show.html.twig', array(
            'entity'        => $entity,
            'cuotas'        => $cuotas,
            'delete_form'   => $deleteForm->createView(),
        	'estadisticas'  => $estadisticas,        
        ));
    }

    /**
     * Displays a form to edit an existing Cuenta entity.
     *
     */
    public function editAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuenta')->findOneBySlug($slug);

        if (!$entity || $entity->getActivo() == 0) {
            throw $this->createNotFoundException('No se encuentra la Cuenta Solicitada');
        }

        $editForm = $this->createForm(new CuentaType(), $entity);
        $deleteForm = $this->createDeleteForm($slug);

        return $this->render('ControlBundle:Cuenta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Cuenta entity.
     *
     */
    public function updateAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuenta')->findOneBySlug($slug);

        if (!$entity || $entity->getActivo()==0) {
            throw $this->createNotFoundException('No se encuentra la cuenta solicitada');
        }

        $deleteForm = $this->createDeleteForm($slug);
        $editForm = $this->createForm(new CuentaType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cuenta_edit', array('slug' => $slug)));
        }

        return $this->render('ControlBundle:Cuenta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Cuenta entity.
     *
     */
    public function deleteAction(Request $request, $slug)
    {
        $form = $this->createDeleteForm($slug);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ControlBundle:Cuenta')->findOneBySlug($slug);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cuenta entity.');
            }
			
            $entity->setActivo(0);
            $em->persist($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cuenta'));
    }

    /**
     * Creates a form to delete a Cuenta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($slug)
    {
        return $this->createFormBuilder(array('slug' => $slug))
            ->add('slug', 'hidden')
            ->getForm()
        ;
    }
}
