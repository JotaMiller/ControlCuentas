<?php

namespace ControlCuentas\ControlBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ControlCuentas\ControlBundle\Entity\Cuota;
use ControlCuentas\ControlBundle\Form\CuotaType;
use ControlCuentas\ControlBundle\Form\CuotaPagarType;

/**
 * Cuota controller.
 *
 */
class CuotaController extends Controller
{

    /**
     * Lists all Cuota entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ControlBundle:Cuota')->findAll();

        return $this->render('ControlBundle:Cuota:index.html.twig', array(
                    'entities' => $entities,
        ));
    }

    /**
     * Creates a new Cuota entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Cuota();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cuota_show', array('id' => $entity->getId())));
        }

        return $this->render('ControlBundle:Cuota:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Cuota entity.
     *
     * @param Cuota $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cuota $entity)
    {
        $form = $this->createForm(new CuotaType(), $entity, array(
            'action' => $this->generateUrl('cuota_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Crear',
            'attr' => array('class' => 'btn btn-primary')
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Cuota entity.
     *
     */
    public function newAction()
    {
        $entity = new Cuota();
        $form = $this->createCreateForm($entity);

        return $this->render('ControlBundle:Cuota:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cuota entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuota')->find($id);
        $estado = $em->getRepository('ControlBundle:Cuota')->findEstado($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuota entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ControlBundle:Cuota:show.html.twig', array(
                    'estado' => $estado,
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to edit an existing Cuota entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuota entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ControlBundle:Cuota:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Cuota entity.
     *
     * @param Cuota $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Cuota $entity)
    {
        $form = $this->createForm(new CuotaType(), $entity, array(
            'action' => $this->generateUrl('cuota_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Cuota entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuota entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cuota_edit', array('id' => $id)));
        }

        return $this->render('ControlBundle:Cuota:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Cuota entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ControlBundle:Cuota')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cuota entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cuota'));
    }

    /**
     * Creates a form to delete a Cuota entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('cuota_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

    /**
     * Despliega el formulario para registrar el pago de vuentas
     * 
     */
    public function ingresarPagoAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuota')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra cuota con id:' . $id);
        }
        
        $form = $this->createForm(new CuotaPagarType(), $entity, array(
            'action' => $this->generateUrl('cuota_pagar',array('id'=>$entity->getId())),
            'method' => 'POST',
        ));

        return $this->render('ControlBundle:Cuota:pagar.html.twig', array(
                    'form' => $form->createView(),
                    'entity' => $entity
        ));
    }
    
    /**
     * Graba el pago ingresado
     * 
     */
    public function pagarAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity = $em->getRepository('ControlBundle:Cuota')->find($id);
        
        if ( !$entity ){
            throw $this->createNotFoundException('No se encuentra cuota con id:' .$id );
        }
        
        $form = $this->createForm(new CuotaPagarType(), $entity, array(
            'action' => $this->generateUrl('cuota_pagar',array('id'=>$entity->getId())),
            'method' => 'POST',
        ));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cuenta_show', array('id' => $entity->getCuenta()->getId())));
        }

        return $this->render('ControlBundle:Cuota:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

}
