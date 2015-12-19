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
 * @Route("/tratamos")
 */
class TratamosController extends Controller{
    
    /**
     * Lists all Categoria entities.
     *
     * @Route("/", name="admin_tratamos")
     * @Method("GET")
     * @Template("SonodigestBundle:Tratamos:tratamos.html.twig")
     */
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
        
        $problemas = $em->getRepository('SonodigestBundle:Problema')->findAll();
        
        return array(
                'problemas' =>$problemas,
        );     
    }
}
