<?php

namespace SonodigestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SonodigestBundle\Entity\TipoCarrusel;
use SonadigestBundle\Entity\Carrusel;
use SonodigestBundle\Form\TipoCarruselType;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * TipoCarrusel controller.
 *
 * @Route("/admin/tipocarrusel")
 */
class TipoCarruselController extends Controller
{

    /**
     * Lists all TipoCarrusel entities.
     *
     * @Route("/", name="admin_tipocarrusel")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SonodigestBundle:TipoCarrusel')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TipoCarrusel entity.
     *
     * @Route("/", name="admin_tipocarrusel_create")
     * @Method("POST")
     * @Template("SonodigestBundle:TipoCarrusel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoCarrusel();
        $entity->setEstado(true);
        $entity->setDetalle("Principal");
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
        
              foreach($entity->getPlacas() as $row){
            
                if($row->getFile()!=null){
                    $path = $this->container->getParameter('photo.carrusel');

                    $fecha = date('Y-m-d His');
                    $extension = $row->getFile()->getClientOriginalExtension();
                    $nombreArchivo = $row->getId()."-"."Imagen"."-".$fecha.".".$extension;

                    $row->setImagen($nombreArchivo);
                    $row->getFile()->move($path,$nombreArchivo);

                    $em->persist($row);
                    $em->flush();

                }  
           } 

            return $this->redirect($this->generateUrl('admin_tipocarrusel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoCarrusel entity.
     *
     * @param TipoCarrusel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoCarrusel $entity)
    {
        $form = $this->createForm(new TipoCarruselType(), $entity, array(
            'action' => $this->generateUrl('admin_tipocarrusel_create'),
            'method' => 'POST',
        ));

        $form->add('submit','submit', array('label' => 'Guardar',
                                               'attr'=>
                                                        array('class'=>'btn btn-success btn-sm')));

        return $form;
    }

    /**
     * Displays a form to create a new TipoCarrusel entity.
     *
     * @Route("/new", name="admin_tipocarrusel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoCarrusel();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoCarrusel entity.
     *
     * @Route("/{id}", name="admin_tipocarrusel_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:TipoCarrusel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCarrusel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoCarrusel entity.
     *
     * @Route("/{id}/edit", name="admin_tipocarrusel_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:TipoCarrusel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCarrusel entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'placas'=>$entity->getPlacas(),
        );
    }

    /**
    * Creates a form to edit a TipoCarrusel entity.
    *
    * @param TipoCarrusel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoCarrusel $entity)
    {
        $form = $this->createForm(new TipoCarruselType(), $entity, array(
            'action' => $this->generateUrl('admin_tipocarrusel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit','submit', array('label' => 'Modificar',
                                               'attr'=>
                                                        array('class'=>'btn btn-success btn-sm')));

        return $form;
    }
    /**
     * Edits an existing TipoCarrusel entity.
     *
     * @Route("/{id}", name="admin_tipocarrusel_update")
     * @Method("PUT")
     * @Template("SonodigestBundle:TipoCarrusel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:TipoCarrusel')->find($id);
     
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoCarrusel entity.');
        }
        
        $originalImagenes= new ArrayCollection();
        $path  = $this->getRequest()->server->get('DOCUMENT_ROOT').'/sonodigest/web/Photos/carrusel/';
        $path2 = $this->container->getParameter('photo.carrusel');    
        // Create an ArrayCollection of the current Tag objects in the database
        $i=0;
        
        $originalImagenes = $entity->getPlacas();
       

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
             foreach ($entity->getPlacas() as $row) {
            
                        
            
               // $galeriaImagenes = new Carrusel();
                if($row->getFile()!=null){
                    $file_path = $path.'/'.$row->getImagen();
                    //echo '*'.$row->getNombre().'*';
                    if(file_exists($file_path) && $row->getImagen()!="") unlink($file_path);
                    //var_dump($row->getFile());
                    //die();
                    //echo "vc";
                    $fecha = date('Y-m-d His');
                    $extension = $row->getFile()->getClientOriginalExtension();
                    $nombreArchivo = "consulta - ".$i." - ".$fecha.".".$extension;

                    //echo $nombreArchivo;
                    //$seguimiento->setFotoAntes($nombreArchivo);


                    $row->setImagen($nombreArchivo);
                    //$imagenConsulta->setConsulta($entity);
                    //array_push($placas, $imagenConsulta);
                    $row->getFile()->move($path2,$nombreArchivo);
                    //$em->merge($seguimiento);
                    $em->persist($row);
                    //$em->flush();
                    $i++;

                }
            
        }
            
        
        
            foreach ($originalImagenes as $row) {
                if (false === $entity->getPlacas()->contains($row)) {
                    // remove the Task from the Tag
                    //$row->getIdcategoria()->removeImagen($row);

                    // if it was a many-to-one relationship, remove the relationship like this
                    //$row->setIdcategoria(null);

                    //$em->persist($row);

                    // if you wanted to delete the Tag entirely, you can also do that
                     $em->remove($row);
                     $em->flush();
                }
            }
        
            $em->flush();
      
 
          

            return $this->redirect($this->generateUrl('admin_tipocarrusel_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TipoCarrusel entity.
     *
     * @Route("/{id}", name="admin_tipocarrusel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SonodigestBundle:TipoCarrusel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoCarrusel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_tipocarrusel'));
    }

    /**
     * Creates a form to delete a TipoCarrusel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_tipocarrusel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
