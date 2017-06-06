<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BatteryPack;
use AppBundle\Form\BatteryPackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Batterypack controller.
 *
 * @Route("batterypack")
 */
class BatteryPackController extends Controller
{
    /**
     * Lists all batteryPack entities.
     *
     * @Route("/", name="batterypack_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $batteryPacks = $em->getRepository('AppBundle:BatteryPack')->findAll();

        return $this->render('batterypack/index.html.twig', array(
            'batteryPacks' => $batteryPacks,
        ));
    }

    /**
     * Creates a new batteryPack entity.
     *
     * @Route("/new", name="batterypack_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $batteryPack = new Batterypack();
        $form = $this->createForm(BatteryPackType::class, $batteryPack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($batteryPack);
            $em->flush();

            return $this->redirectToRoute('batterypack_show', array('id' => $batteryPack->getId()));
        }

        return $this->render('batterypack/new.html.twig', array(
            'batteryPack' => $batteryPack,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a batteryPack entity.
     *
     * @Route("/{id}", name="batterypack_show")
     * @Method("GET")
     */
    public function showAction(BatteryPack $batteryPack)
    {
        $deleteForm = $this->createDeleteForm($batteryPack);

        return $this->render('batterypack/show.html.twig', array(
            'batteryPack' => $batteryPack,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing batteryPack entity.
     *
     * @Route("/{id}/edit", name="batterypack_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BatteryPack $batteryPack)
    {
        $deleteForm = $this->createDeleteForm($batteryPack);
        $editForm = $this->createForm('AppBundle\Form\BatteryPackType', $batteryPack);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('batterypack_edit', array('id' => $batteryPack->getId()));
        }

        return $this->render('batterypack/edit.html.twig', array(
            'batteryPack' => $batteryPack,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a batteryPack entity.
     *
     * @Route("/{id}", name="batterypack_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BatteryPack $batteryPack)
    {
        $form = $this->createDeleteForm($batteryPack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($batteryPack);
            $em->flush();
        }

        return $this->redirectToRoute('batterypack_index');
    }

    /**
     * Creates a form to delete a batteryPack entity.
     *
     * @param BatteryPack $batteryPack The batteryPack entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BatteryPack $batteryPack)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('batterypack_delete', array('id' => $batteryPack->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
