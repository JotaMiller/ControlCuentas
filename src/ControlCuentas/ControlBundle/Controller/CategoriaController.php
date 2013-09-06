<?php
namespace ControlCuentas\ControlBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nelmio\ApiDocBundle\Annotation\ApiDoc as ApiDoc;

use ControlCuentas\ControlBundle\Entity\Categoria;
use ControlCuentas\ControlBundle\Form\CategoriaType;

/**
 * Categoria controller.
 *
 */
class CategoriaController extends Controller
{

    /**
     * Lists all Categoria entities.
     * @ApiDoc(
     *  resource=true,
     *  description="Lista todas las categorias"
     * )
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();
        
        $entities = $em->getRepository('ControlBundle:Categoria')->findByUsuario($usuario->getId());

        return $this->render('ControlBundle:Categoria:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    
    /**
     * Creates a new Categoria entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Categoria();
        $usuario = $this->getUser();
        
        $form = $this->createForm(new CategoriaType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUsuario($usuario);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categoria_show', array('id' => $entity->getId())));
        }

        return $this->render('ControlBundle:Categoria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Categoria entity.
     *
     */
    public function newAction()
    {
        $entity = new Categoria();
        $form   = $this->createForm(new CategoriaType(), $entity);

        return $this->render('ControlBundle:Categoria:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categoria entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->getUser();
            
        $entity = $em->getRepository('ControlBundle:Categoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoria entity.');
        }
        
        // Solo mostrar los registros que le pertenecen al usuario
        if ( $entity->getUsuario()->getId() != $usuario->getId() ){
            throw $this->createNotFoundException('No se encuentra la categoria en sus registros');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ControlBundle:Categoria:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Categoria entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Categoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoria entity.');
        }

        $editForm = $this->createForm(new CategoriaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ControlBundle:Categoria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Categoria entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ControlBundle:Categoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new CategoriaType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categoria_edit', array('id' => $id)));
        }

        return $this->render('ControlBundle:Categoria:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Categoria entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ControlBundle:Categoria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categoria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('categoria'));
    }

    /**
     * Creates a form to delete a Categoria entity by id.
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
