<?php

namespace ControlCuentas\ControlBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CuentaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('tipocuenta')
                ->add('categoria')
                ->add('nombre')
                ->add('descripcion')
                ->add('cantidadCuotas', 'integer', array(
                    'label' => 'Numero de Cuotas',
                    'mapped' => false
                ))
                ->add('fechaPrimeraCuota', 'date', array(
                    'mapped' => false,
                    'widget' =>'single_text'
                ))
                ->add('montoCuota','money',array(
                    'currency' => false,
                    'precision' => 0,
                    'mapped' => false,
                ))
                ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ControlCuentas\ControlBundle\Entity\Cuenta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'controlcuentas_controlbundle_cuentatype';
    }
}
