<?php
//@TODO: Implementar extensión para calculo de edad con funciones PHP (interval)
namespace ControlCuentas\ControlBundle\Twig\Extension;

class CalcularEdad extends \Twig_Extension
{
   
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Calcular edad';
    }
}
