<?php

namespace ControlCuentas\ControlBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CuotaPagarType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('monto_pagado', null, array(
                    'label_attr'=>array('class'=>'col-lg-2 control-label'),
                    'attr' => array('class'=>'form-control'),
                ))
                ->add('fecha_pago', 'date', array(
                    'widget' => 'single_text',
                    'label_attr'=>array('class'=>'col-lg-2 control-label'),
                    'attr' => array('class'=>'form-control'),
                    ))
                ->add('formapago',null,array(
                    'label_attr'=>array('class'=>'col-lg-2 control-label'),
                    'attr' => array('class'=>'form-control'),
                ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ControlCuentas\ControlBundle\Entity\Cuota'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'controlcuentas_controlbundle_cuota_pagar';
    }

}
