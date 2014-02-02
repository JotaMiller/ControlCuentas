<?php

namespace ControlCuentas\ControlBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ControlCuentas\ControlBundle\Entity\Cuentafija;
use ControlCuentas\ControlBundle\Form\CuentafijaType;

/**
 * Cuentafija controller.
 *
 */
class CuentafijaController extends Controller
{

    /**
     * Lists all Cuentafija entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ControlBundle:Cuentafija')->findAll();

        return $this->render('ControlBundle:Cuentafija:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Cuentafija entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Cuentafija();
        $usuario = $this->getUser();
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
        	$tipocuenta         =   $em->getRepository('ControlBundle:Tipocuenta')->findOneByNum(2); // Cuentas Fijas
            
        	$entity->setUsuario($usuario);
            $entity->setActivo(true);
            $entity->setTipocuenta($tipocuenta);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cuentafija_show', array('id' => $entity->getId())));
        }

        return $this->render('ControlBundle:Cuentafija:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Cuentafija entity.
     *
     * @param Cuentafija $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cuentafija $entity)
    {
        $form = $this->createForm(new CuentafijaType(), $entity, array(
            'action' => $this->generateUrl('cuentafija_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Cuentafija entity.
     *
     */
    public function newAction()
    {
        $entity = new Cuentafija();
        $form   = $this->createCreateForm($entity);

        return $this->render('ControlBundle:Cuentafija:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Cuentafija entity.
     *
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuentafija')->findOneBySlug($slug);

        if (!$entity || $entity->getActivo() == 0) {
            throw $this->createNotFoundException('Unable to find Cuentafija entity.');
        }

        $deleteForm = $this->createDeleteForm($slug);

        return $this->render('ControlBundle:Cuentafija:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Cuentafija entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuentafija')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuentafija entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ControlBundle:Cuentafija:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Cuentafija entity.
    *
    * @param Cuentafija $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cuentafija $entity)
    {
        $form = $this->createForm(new CuentafijaType(), $entity, array(
            'action' => $this->generateUrl('cuentafija_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Cuentafija entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Cuentafija')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cuentafija entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cuentafija_edit', array('id' => $id)));
        }

        return $this->render('ControlBundle:Cuentafija:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Cuentafija entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ControlBundle:Cuentafija')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cuentafija entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cuentafija'));
    }

    /**
     * Creates a form to delete a Cuentafija entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($slug)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cuentafija_delete', array('slug' => $slug)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
            		'label' => 'Eliminar Cuenta',
            		'attr' => array('class'=>'btn btn-danger pull-right'),
            ))
            ->getForm()
        ;
    }
}
