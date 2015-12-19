<?php

namespace SonodigestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Categoria controller.
 *
 * @Route("/fotos")
 */
class FotosController extends Controller{
    
    /**
     * Lists all Categoria entities.
     *
     * @Route("/", name="admin_fotos")
     * @Method("GET")
     * @Template("SonodigestBundle:Galeria:galeriafotos.html.twig")
     */
    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SonodigestBundle:CategoriaImagen')->findAll();
        
        $fotos = $em->getRepository('SonodigestBundle:GaleriaImagenes')->findAll();
        
        //var_dump($entities);
        //var_dump($fotos);
        
        
        
        return array(
            'categoriasImagenes'=>$entities,
            'fotos'=>$fotos,
        );     
    }
}
