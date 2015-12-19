<?php

namespace SonodigestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use SonodigestBundle\Form\ImagenblogType;

class EntradaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('id')
            ->add('titulo', 'text', array(
                'required' => true
            ))
            ->add('escritapor', 'text', array(
                'required' => true,
                'label' => 'Escrita por'
            ))
            //->add('fecha')
            ->add('contenido', 'textarea',array(
                  'required' => true,
                  'attr' => array(
                        'class' => 'tinymce',
                        'data-theme' => 'bbcode' // Skip it if you want to use default theme
                    ))
            )
            ->add('idimagen', new ImagenblogType(), array(
                'label' => ' '
            ))
            ->add('idcategoria', null, array(
                'label' => 'Elija una categoria'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SonodigestBundle\Entity\Entrada'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sonodigestbundle_entrada';
    }
}
