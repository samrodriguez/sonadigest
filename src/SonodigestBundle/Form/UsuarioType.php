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
            ->add('username',null,array('label' => 'Usuario','required'=>false,
                    'attr'=>array(
                    'class'=>'form-control input-sm nombreUsuario'
                    ))) 
            ->add('password','repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'La contraseña no son iguales',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => false,
                    'first_options'  => array('label' => 'Contraseña','required'=>false,
                    'attr'=>array(
                    'class'=>'form-control input-sm firstPassword'
                    )),
                    'second_options' => array('label' => 'Confirmar contraseña','required'=>false,
                    'attr'=>array(
                    'class'=>'form-control input-sm secondPassword'
                    )),
                ))
            //->add('salt')
            ->add('persona',null, array(
                //'empty_value' => 'Seleccione una opcion',
                'label' => 'Elija una persona',
                'required' => false,
                'attr'=>array(
                    'class'=>'form-control input-sm persona'
                    )
            ))
            ->add('user_roles','entity',array('label' => 'Seleccione un rol','required'=>false,
                'class'=>'SonodigestBundle:Rol','property'=>'nombre',
                'multiple'=>true,
                'expanded'=>true,
                    'attr'=>array(
                    'class'=>'rolUsuario'
                    ))); 
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
