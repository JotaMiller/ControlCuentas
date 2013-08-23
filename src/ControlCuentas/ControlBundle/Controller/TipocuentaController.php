<?php

namespace ControlCuentas\ControlBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ControlCuentas\ControlBundle\Entity\Tipocuenta;
use ControlCuentas\ControlBundle\Form\TipocuentaType;

/**
 * Tipocuenta controller.
 *
 */
class TipocuentaController extends Controller
{

    /**
     * Lists all Tipocuenta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ControlBundle:Tipocuenta')->findAll();

        return $this->render('ControlBundle:Tipocuenta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Tipocuenta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Tipocuenta();
        $form = $this->createForm(new TipocuentaType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipocuenta_show', array('id' => $entity->getId())));
        }

        return $this->render('ControlBundle:Tipocuenta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Tipocuenta entity.
     *
     */
    public function newAction()
    {
        $entity = new Tipocuenta();
        $form   = $this->createForm(new TipocuentaType(), $entity);

        return $this->render('ControlBundle:Tipocuenta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Tipocuenta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Tipocuenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipocuenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ControlBundle:Tipocuenta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Tipocuenta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Tipocuenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipocuenta entity.');
        }

        $editForm = $this->createForm(new TipocuentaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ControlBundle:Tipocuenta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Tipocuenta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Tipocuenta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tipocuenta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TipocuentaType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tipocuenta_edit', array('id' => $id)));
        }

        return $this->render('ControlBundle:Tipocuenta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Tipocuenta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ControlBundle:Tipocuenta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tipocuenta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tipocuenta'));
    }

    /**
     * Creates a form to delete a Tipocuenta entity by id.
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
