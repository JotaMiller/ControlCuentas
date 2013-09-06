<?php
namespace ControlCuentas\ControlBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Nelmio\ApiDocBundle\Annotation\ApiDoc as ApiDoc;

use ControlCuentas\ControlBundle\Entity\Usuario;

/**
 * Categoria controller.
 *
 */
class UsuarioController extends Controller
{
    /**
     * Devuelve una lista de todos los usuarios registrados en el sistema
     * 
     * @ApiDoc(
     *  resource=true,
     *  section="API",
     *  description="Lista de Todos los usuarios"
     * )
     */
    public function allAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $usuarios = $em->getRepository('ControlBundle:Usuario')->findAll();
        $arrDatos = array();
        
        foreach ($usuarios as $k => $usuario){
            $arrDatos[$k]['id'] = $usuario->getId();
            $arrDatos[$k]['usuario'] = $usuario->getUsername();
            $arrDatos[$k]['email'] = $usuario->getEmail();
            $arrDatos[$k]['roles'] = $usuario->getRoles();
        }
        return new JsonResponse($arrDatos);
    }
    
    /**
     * Devuelve la información del usuario indicado
     * 
     * @ApiDoc(
     *  section="API"
     * )
     */
    public function getAction( Request $request, $id )
    {
        $em = $this->getDoctrine()->getManager();
        
        $usuario = $em->getRepository('ControlBundle:Usuario')->find( $id );
        $arrDatos = array();
        $arrDatos['id'] = $usuario->getId();
        $arrDatos['usuario'] = $usuario->getUsername();
        $arrDatos['email'] = $usuario->getEmail();
        $arrDatos['roles'] = $usuario->getRoles();
        return new JsonResponse($arrDatos);
    }
}