<?php

namespace SonodigestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SonodigestBundle\Entity\Carrusel;
use SonodigestBundle\Form\CarruselType;

/**
 * Carrusel controller.
 *
 * @Route("/admin/carrusel")
 */
class CarruselController extends Controller
{

    /**
     * Lists all Carrusel entities.
     *
     * @Route("/", name="admin_carrusel")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SonodigestBundle:Carrusel')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Carrusel entity.
     *
     * @Route("/", name="admin_carrusel_create")
     * @Method("POST")
     * @Template("SonodigestBundle:Carrusel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Carrusel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carrusel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Carrusel entity.
     *
     * @param Carrusel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Carrusel $entity)
    {
        $form = $this->createForm(new CarruselType(), $entity, array(
            'action' => $this->generateUrl('admin_carrusel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Carrusel entity.
     *
     * @Route("/new", name="admin_carrusel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Carrusel();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Carrusel entity.
     *
     * @Route("/{id}", name="admin_carrusel_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Carrusel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrusel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Carrusel entity.
     *
     * @Route("/{id}/edit", name="admin_carrusel_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Carrusel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrusel entity.');
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
    * Creates a form to edit a Carrusel entity.
    *
    * @param Carrusel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Carrusel $entity)
    {
        $form = $this->createForm(new CarruselType(), $entity, array(
            'action' => $this->generateUrl('admin_carrusel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Carrusel entity.
     *
     * @Route("/{id}", name="admin_carrusel_update")
     * @Method("PUT")
     * @Template("SonodigestBundle:Carrusel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SonodigestBundle:Carrusel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrusel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_carrusel_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Carrusel entity.
     *
     * @Route("/{id}", name="admin_carrusel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SonodigestBundle:Carrusel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Carrusel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_carrusel'));
    }

    /**
     * Creates a form to delete a Carrusel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_carrusel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
