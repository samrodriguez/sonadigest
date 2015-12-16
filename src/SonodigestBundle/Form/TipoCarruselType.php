<?php

namespace SonodigestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TipoCarruselType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
       /*     ->add('detalle',null,array('label' => 'Descripción','required'=>false,
                    'attr'=>array(
                    'class'=>'form-control input-sm detalleCarrusel'
                    )))*/
           // ->add('estado')
                
           /* ->add('file',null, array('label'=>'Imagen','required'=>false,
                    'attr'=>array('class'=>'imagenCarrusel' ,
                    'multiple' => true,
                    'expanded'=>'true', 
                    'collection'=>'true'
                        
                    )))     */
                
             ->add('placas','collection',array(
                'type' => new CarruselType(),
                'label'=>' ',
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                ))          
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SonodigestBundle\Entity\TipoCarrusel'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sonodigestbundle_tipocarrusel';
    }
}
