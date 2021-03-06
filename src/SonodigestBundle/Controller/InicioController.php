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
 * @Route("/inicio")
 */
class InicioController extends Controller{
    
    /**
     * Lists all Categoria entities.
     *
     * @Route("/", name="admin_inicio")
     * @Method("GET")
     * @Template("SonodigestBundle:Inicio:inicio.html.twig")
     */
    public function indexAction()
    {
        // return $this->render('SonodigestBundle:Inicio:inicio.html.twig');  
        
         $em = $this->getDoctrine()->getManager();
         $idcarrusel =  $em->getRepository('SonodigestBundle:Carrusel')->findAll();
         
         return array('fotoscarrusel'=>$idcarrusel);
         
    }
}
