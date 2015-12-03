<?php

namespace SonodigestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProblemaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo','text',array(
                'required' => true ,
            ))
            //->add('foto')
            ->add('descripcion', 'textarea', array(
                'required' => true,
                'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'bbcode' // Skip it if you want to use default theme
                )
            ))
            /*->add('idsubcategoria','entity', array(
                'class' => 'SonodigestBundle:Subcategoria',
                'required' => true,
                'empty_value' => 'Seleccione un problema',
                'multiple' => false ,
                'expanded' => false
            ))*/
            ->add('file',null, array(
                    'label'=>'Foto de problema','required'=>false,
                    'required' => false,
                    'attr'=>array('class'=>'Problema'
                    )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SonodigestBundle\Entity\Problema'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sonodigestbundle_problema';
    }
}
