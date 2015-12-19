<?php

namespace SonodigestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SonodigestBundle\Entity\CategoriaImagen;
use SonodigestBundle\Entity\GaleriaImagenes;
use SonodigestBundle\Form\CategoriaImagenType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * CategoriaImagen controller.
 *
 * @Route("/admin/categoriaimagen")
 */
class CategoriaImagenController extends Controller
{

    /**
     * Lists all CategoriaImagen entities.
     *
     * @Route("/", name="admin_categoriaimagen")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SonodigestBundle:CategoriaImagen')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CategoriaImagen entity.
     *
     * @Route("/", name="admin_categoriaimagen_create")
     * @Method("POST")
     * @Template("SonodigestBundle:CategoriaImagen:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CategoriaImagen();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($entity);
            //var_dump($entity->getImagenes());
            //die();
            $path = $this->container->getParameter('photo.galeriafotos');    
            $i=0;
            foreach($entity->getImagenes() as $key => $row){
                //var_dump($row);    
                //die();
                
                $galeriaImagenes = new GaleriaImagenes();
                if($row->getFile()!=null){
                    
                    //echo "vc";
                    $fecha = date('Y-m-d His');
                    $extension = $row->getFile()->getClientOriginalExtension();
                    $nombreArchivo = "consulta - ".$i." - ".$fecha.".".$extension;

                    //echo $nombreArchivo;
                    //$seguimiento->setFotoAntes($nombreArchivo);

                    
                    $row->setNombre($nombreArchivo);
                    //$imagenConsulta->setConsulta($entity);
                    //array_push($placas, $imagenConsulta);
                    $row->getFile()->move($path,$nombreArchivo);
                    //$em->merge($seguimiento);
                    $em->persist($row);
                    //$em->flush();
                    $i++;
                
                }
                //var_dump($row->getFile());  
            }
            
            
            
            
            
            $em->flush();

            return $this->redirect($this->generateUrl('admin_categoriaimagen_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CategoriaImagen entity.
     *
     * @param CategoriaImagen $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CategoriaImagen $entity)
    {
        $form = $this->createForm(new CategoriaImagenType(), $entity, array(
            'action' => $this->generateUrl('admin_categoriaimagen_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar',
            'attr'=>array('class'=>'btn-success btn-sm btn')));

        return $form;
    }

    /**
     * Displays a form to create a new CategoriaImagen entity.
     *
     * @Route("/new", name="admin_categoriaimagen_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CategoriaImagen();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CategoriaImagen entity.
     *
     * @Route("/{id}", name="admin_categoriaimagen_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:CategoriaImagen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoriaImagen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CategoriaImagen entity.
     *
     * @Route("/{id}/edit", name="admin_categoriaimagen_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:CategoriaImagen')->find($id);
        //$newFile = new UploadedFile();
        
        //die();
        $path = $this->container->getParameter('photo.galeriafotos');
        $path= $this->container->getParameter('kernel.root_dir') . '/../web/';
        $path = $this->container->getParameter('kernel.root_dir').'/../web';
        $path  = $this->getRequest()->server->get('DOCUMENT_ROOT').'/sonodigest/web/Photos/galeriafotos/';
        //echo $path;
        
        //var_dump($newFile);
        //die();
        //$entity->setFile($entity->getNombre());
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoriaImagen entity.');
        }
        
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'imagenes'=>$entity->getImagenes(),
        );
    }

    /**
    * Creates a form to edit a CategoriaImagen entity.
    *
    * @param CategoriaImagen $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CategoriaImagen $entity)
    {
        $form = $this->createForm(new CategoriaImagenType(), $entity, array(
            'action' => $this->generateUrl('admin_categoriaimagen_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modificar','attr'=>array('class'=>'btn-success btn-sm btn')));

        return $form;
    }
    /**
     * Edits an existing CategoriaImagen entity.
     *
     * @Route("/{id}", name="admin_categoriaimagen_update")
     * @Method("PUT")
     * @Template("SonodigestBundle:CategoriaImagen:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:CategoriaImagen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CategoriaImagen entity.');
        }

        /*$deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
*/
        $originalImagenes= new ArrayCollection();
        $path  = $this->getRequest()->server->get('DOCUMENT_ROOT').'/sonodigest/web/Photos/galeriafotos/';
        $path2 = $this->container->getParameter('photo.galeriafotos');    
        // Create an ArrayCollection of the current Tag objects in the database
        $i=0;
        
        $originalImagenes = $entity->getImagenes();
        foreach ($entity->getImagenes() as $row) {
            
            
            
        }

        $editForm = $this->createEditForm($entity);

        $editForm->handleRequest($request);

        
        foreach ($originalImagenes as $row) {
                $file_path = $path.'/'.$row->getNombre();
                    //echo '*'.$row->getNombre().'*';
                if(file_exists($file_path) && $row->getNombre()!="") //unlink($file_path);
                if (false === $entity->getImagenes()->contains($row)) {
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
        
        if ($editForm->isValid()) {
            
            foreach ($entity->getImagenes() as $row) {
            
                        
            
                //$galeriaImagenes = new GaleriaImagenes();
                if($row->getFile()!=null){
                    $file_path = $path.'/'.$row->getNombre();
                    //echo '*'.$row->getNombre().'*';
                    if(file_exists($file_path) && $row->getNombre()!="") unlink($file_path);
                    //var_dump($row->getFile());
                    //die();
                    //echo "vc";
                    $fecha = date('Y-m-d His');
                    $extension = $row->getFile()->getClientOriginalExtension();
                    $nombreArchivo = "consulta - ".$i." - ".$fecha.".".$extension;

                    //echo $nombreArchivo;
                    //$seguimiento->setFotoAntes($nombreArchivo);


                    $row->setNombre($nombreArchivo);
                    //$imagenConsulta->setConsulta($entity);
                    //array_push($placas, $imagenConsulta);
                    $row->getFile()->move($path2,$nombreArchivo);
                    //$em->merge($seguimiento);
                    $em->persist($row);
                    //$em->flush();
                    $i++;

                }
            
        }
            
            
            // remove the relationship between the tag and the Task
            
            
            
            $em->flush();

            return $this->redirect($this->generateUrl('admin_categoriaimagen_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CategoriaImagen entity.
     *
     * @Route("/{id}", name="admin_categoriaimagen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SonodigestBundle:CategoriaImagen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CategoriaImagen entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_categoriaimagen'));
    }

    /**
     * Creates a form to delete a CategoriaImagen entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_categoriaimagen_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
