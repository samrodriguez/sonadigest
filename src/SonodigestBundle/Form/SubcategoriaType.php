<?php

namespace SonodigestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SubcategoriaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('titulo')
            //->add('foto')
            ->add('descripcion')
            ->add('idcategoria')
            ->add('idproblema')
            ->add('file',null, array('label'=>'Foto de Subcategoria','required'=>false,
                    'attr'=>array('class'=>'Subcategoria'
                    )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SonodigestBundle\Entity\Subcategoria'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sonodigestbundle_subcategoria';
    }
}
