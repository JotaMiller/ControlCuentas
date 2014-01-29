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
        $builder->add('categoria',null,array(
                	'attr'=>array('class'=>' select2able'),
                	'label_attr'=>array('class'=>'control-label col-lg-2'),
                ))
                ->add('nombre',null,array(
                	'attr'=>array('class'=>'form-control'),
                	'label_attr'=>array('class'=>'control-label col-lg-2'),
                ))
                ->add('descripcion',null,array(
                	'attr'=>array('class'=>'form-control'),
                	'label_attr'=>array('class'=>'control-label col-lg-2'),
                ))
                ->add('cantidadCuotas', 'integer', array(
                    'label' => 'Cantidad de Cuotas',
                    'mapped' => false,
                	'attr'=>array('class'=>'form-control'),
                	'label_attr'=>array('class'=>'control-label col-lg-2'),
                ))
				->add('cuotasIndefinidas','checkbox',array(
					"mapped" => false,
					'label'     => 'Gastos Fijos',
    				'required'  => false,
// 					'attr'=>array('class'=>'form-control'),
// 					'label_attr'=>array('class'=>'control-label col-lg-2'),
				))
                ->add('fechaPrimeraCuota', 'date', array(
               		'attr'=>array('class'=>'form-control'),
               		'label_attr'=>array('class'=>'control-label col-lg-2'),
                    'mapped' => false,
                    'widget' =>'single_text'
                ))
                ->add('montoCuota','money',array(
                	'attr'=>array('class'=>'form-control'),
                	'label_attr'=>array('class'=>'control-label col-lg-2'),
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
