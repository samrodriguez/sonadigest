<?php

namespace SonodigestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SonodigestBundle\Entity\Imagenblog;
use SonodigestBundle\Form\ImagenblogType;

/**
 * Imagenblog controller.
 *
 * @Route("/admin/imagenblog")
 */
class ImagenblogController extends Controller
{

    /**
     * Lists all Imagenblog entities.
     *
     * @Route("/", name="admin_imagenblog")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SonodigestBundle:Imagenblog')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Imagenblog entity.
     *
     * @Route("/", name="admin_imagenblog_create")
     * @Method("POST")
     * @Template("SonodigestBundle:Imagenblog:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Imagenblog();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('admin_imagenblog_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Imagenblog entity.
     *
     * @param Imagenblog $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Imagenblog $entity)
    {
        $form = $this->createForm(new ImagenblogType(), $entity, array(
            'action' => $this->generateUrl('admin_imagenblog_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Imagenblog entity.
     *
     * @Route("/new", name="admin_imagenblog_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Imagenblog();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Imagenblog entity.
     *
     * @Route("/{id}", name="admin_imagenblog_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Imagenblog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagenblog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Imagenblog entity.
     *
     * @Route("/{id}/edit", name="admin_imagenblog_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Imagenblog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagenblog entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Imagenblog entity.
    *
    * @param Imagenblog $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Imagenblog $entity)
    {
        $form = $this->createForm(new ImagenblogType(), $entity, array(
            'action' => $this->generateUrl('admin_imagenblog_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Imagenblog entity.
     *
     * @Route("/{id}", name="admin_imagenblog_update")
     * @Method("PUT")
     * @Template("SonodigestBundle:Imagenblog:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Imagenblog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Imagenblog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_imagenblog_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Imagenblog entity.
     *
     * @Route("/{id}", name="admin_imagenblog_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SonodigestBundle:Imagenblog')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Imagenblog entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_imagenblog'));
    }

    /**
     * Creates a form to delete a Imagenblog entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_imagenblog_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
