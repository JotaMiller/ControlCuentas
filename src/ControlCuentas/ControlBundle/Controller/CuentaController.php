<?php

namespace ControlCuentas\ControlBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ControlCuentas\ControlBundle\Entity\Cuenta;
use ControlCuentas\ControlBundle\Form\CuentaType;

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

        $entities = $em->getRepository('ControlBundle:Cuenta')->findAll();

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
        $form = $this->createForm(new CuentaType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
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
