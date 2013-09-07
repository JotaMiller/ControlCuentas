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
     * Lists all Cuenta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();
        
        $entities = $em->getRepository('ControlBundle:Cuenta')->findByUsuario($usuario->getId());

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
            $tipoCuenta         =   $form->get('tipocuenta')->getData();
            
            $numero_cuotas      =   $form->get('cantidadCuotas')->getData();
            $monto_pactado      =   $form->get('montoCuota')->getData();
            $fecha_vencimiento  =   $form->get('fechaPrimeraCuota')->getData();
                                    
//            ld($fecha_vencimiento->add(new \DateInterval('P12M')));
            $entity->setUsuario($usuario);
            $em->persist($entity);
            
            if ($tipoCuenta->getId() == 1){
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

            return $this->redirect($this->generateUrl('cuenta_show', array('id' => $entity->getId())));
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
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ControlBundle:Cuenta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Cuenta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuenta entity.');
        }

        $editForm = $this->createForm(new CuentaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

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
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CuentaType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cuenta_edit', array('id' => $id)));
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
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ControlBundle:Cuenta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cuenta entity.');
            }

            $em->remove($entity);
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
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
