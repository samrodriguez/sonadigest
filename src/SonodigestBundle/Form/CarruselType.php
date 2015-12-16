<?php

namespace SonodigestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CarruselType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('imagen',null, array('label'=>'Imagen Actual','required'=>false,
                    'attr'=>array('class'=>'imagenActual'
                        
                    )))    
            //->add('tipoCarrusel')
            ->add('file',null, array('label'=>'Imagen','required'=>false,
                    'attr'=>array('class'=>'imagen'
                        
                    )))    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SonodigestBundle\Entity\Carrusel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sonodigestbundle_carrusel';
    }
}
