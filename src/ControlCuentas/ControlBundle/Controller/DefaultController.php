<?php

namespace ControlCuentas\ControlBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ControlBundle:Default:index.html.twig');
    }
}
