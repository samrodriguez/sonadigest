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
 * @Route("/problemadetalle")
 */
class ProblemadetalleController extends Controller{
    
    /**
     * Lists all Categoria entities.
     *
     * @Route("/{id}", name="admin_problemadetalle")
     * @Method("GET")
     * @Template("SonodigestBundle:Problemadetalle:problemadetalle.html.twig")
     */
    public function indexAction($id)
    {
        
        $em = $this->getDoctrine()->getManager();

//      $entities = $em->getRepository('SonodigestBundle:Categoriablog')->findAll();
        $entities = $em->getRepository('SonodigestBundle:Problema')->find($id);
        $idMax = $em->getRepository('SonodigestBundle:Problema')->findBy(array(),array('id'=>'DESC'));
        //var_dump($idMax);
        //$entities = $em->getRepository('SonodigestBundle:Problema')->findAll();
        $idMax = $idMax[0]->getId();
        $encontrado=true;
        $problemas_random=array();
        $idRecuperados=array();
        //var_dump($problemas_random);
        while(count($problemas_random)<4){
            
            
            $random = rand(1,$idMax);
            //var_dump($random);
            if($random!=$id){
                $prob= $em->getRepository('SonodigestBundle:Problema')->find($random);
                
                if(!in_array($random, $idRecuperados, true)){
                    
                
                    if(count($prob)!=0){
                        array_push ($problemas_random, $prob);
                        array_push ($idRecuperados, $random);
                    }
                }
                    
                
            }
        }
        //var_dump($problemas_random);
        //var_dump($idRecuperados);
        
        
        
        return array(
            'problema'=>$entities,
            'problemasRandom'=>$problemas_random,
        );     
    }
}
