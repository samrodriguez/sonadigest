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
 * @Route("/admin/tratamos")
 */
class TratamosController extends Controller{
    
    /**
     * Lists all Categoria entities.
     *
     * @Route("/", name="admin_tratamos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
         return $this->render('SonodigestBundle:Tratamos:tratamos.html.twig');     
    }
}
