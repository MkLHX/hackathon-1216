<?php

namespace GoFlashBundle\Controller;

use GoFlashBundle\Entity\Jeu;
use GoFlashBundle\Form\JeuType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Jeu controller.
 *
 * @Route("/jeux")
 */
class JeuController extends Controller
{
    /**
     * Lists all jeu entities.
     *
     * @Route("/", name="jeu_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jeux = $em->getRepository('GoFlashBundle:Jeu')->findAll();

        return $this->render('@GoFlash/jeu/index.html.twig', array(
            'jeux' => $jeux,
        ));
    }
/* ---------------------------------------- NEW ----------------------------------------- */
    /**
     * Creates a new jeu entity.
     *
     * @Route("/new", name="jeu_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $jeu = new Jeu();
        $form = $this->createForm('GoFlashBundle\Form\JeuType', $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($jeu);
            $em->flush($jeu);

            $this->addFlash(
                'success',
                'Votre jeu a bien été ajouté'
            );

            return $this->redirectToRoute('accueil');
        }

        return $this->render('@GoFlash/jeu/new.html.twig', array(
            'jeu' => $jeu,
            'form' => $form->createView(),
        ));

    }

/* -------------------------------------- SHOW ---------------------------------------- */
    /**
     * Finds and displays a jeu entity.
     *
     * @Route("/{id}/show", name="jeu_show")
     * @Method("GET")
     */
    public function showAction(Jeu $jeu)
    {
        $deleteForm = $this->createDeleteForm($jeu);

        return $this->render('@GoFlash/jeu/show.html.twig', array(
            'jeu' => $jeu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

/* ---------------------------------------- EDIT ---------------------------------------- */
    /**
     * Displays a form to edit an existing jeu entity.
     *
     * @Route("/{id}/edit", name="jeu_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Jeu $jeu)
    {
        $deleteForm = $this->createDeleteForm($jeu);
        $editForm = $this->createForm('GoFlashBundle\Form\JeuType', $jeu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jeu_edit', array('id' => $jeu->getId()));
        }

        return $this->render('@GoFlash/jeu/edit.html.twig', array(
            'jeu' => $jeu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

/* -------------------------------------------- DELETE -------------------------------------- */
    /**
     * Deletes a jeu entity.
     *
     * @Route("/{id}/delete", name="jeu_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Jeu $jeu)
    {
        $form = $this->createDeleteForm($jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jeu);
            $em->flush($jeu);
        }

        return $this->redirectToRoute('jeu_index');
    }

    /**
     * Creates a form to delete a jeu entity.
     *
     * @param Jeu $jeu The jeu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Jeu $jeu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jeu_delete', array('id' => $jeu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
