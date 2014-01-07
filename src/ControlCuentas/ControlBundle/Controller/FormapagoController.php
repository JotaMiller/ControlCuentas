<?php

namespace ControlCuentas\ControlBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ControlCuentas\ControlBundle\Entity\Formapago;
use ControlCuentas\ControlBundle\Form\FormapagoType;

/**
 * Formapago controller.
 *
 */
class FormapagoController extends Controller
{

    /**
     * Lists all Formapago entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ControlBundle:Formapago')->findAll();

        return $this->render('ControlBundle:Formapago:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Formapago entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Formapago();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formapago_show', array('id' => $entity->getId())));
        }

        return $this->render('ControlBundle:Formapago:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Formapago entity.
     *
     * @param Formapago $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Formapago $entity)
    {
        $form = $this->createForm(new FormapagoType(), $entity, array(
            'action' => $this->generateUrl('formapago_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Formapago entity.
     *
     */
    public function newAction()
    {
        $entity = new Formapago();
        $form   = $this->createCreateForm($entity);

        return $this->render('ControlBundle:Formapago:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Formapago entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Formapago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formapago entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ControlBundle:Formapago:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Formapago entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Formapago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formapago entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ControlBundle:Formapago:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Formapago entity.
    *
    * @param Formapago $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Formapago $entity)
    {
        $form = $this->createForm(new FormapagoType(), $entity, array(
            'action' => $this->generateUrl('formapago_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Formapago entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Formapago')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formapago entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('formapago_edit', array('id' => $id)));
        }

        return $this->render('ControlBundle:Formapago:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Formapago entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ControlBundle:Formapago')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Formapago entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('formapago'));
    }

    /**
     * Creates a form to delete a Formapago entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formapago_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
