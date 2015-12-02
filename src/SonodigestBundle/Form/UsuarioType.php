<?php

namespace SonodigestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'text', array('required' => false,
                'attr'=>array(
                    'class'=>'form-control input-sm nombreUsuario'
                    )
            ))
            ->add('password','password', array(
                'required' => false,
                'attr'=>array(
                    'class'=>'form-control input-sm firstPassword'
                    )
            ))
            //->add('salt')
            ->add('idpersona',null, array(
                'empty_value' => 'Seleccione una opcion',
                'label' => 'Elija una persona',
                'required' => false,
                'attr'=>array(
                    'class'=>'form-control input-sm persona'
                    )
            ))
            ->add('idrol' , 'entity', array(
                'required' => false,
                'label' => 'Tipo de rol',
                'class' => 'SonodigestBundle:Rol' ,
                'multiple'  => true, 
                'expanded'  => true,
                'attr'=>array(
                    'class'=>'form-control input-sm rolUsuario'
                    )
                )
        ); 
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SonodigestBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sonodigestbundle_usuario';
    }
}
