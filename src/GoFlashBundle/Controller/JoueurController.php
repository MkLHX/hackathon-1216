<?php

namespace GoFlashBundle\Controller;

use GoFlashBundle\Entity\Jeu;
use GoFlashBundle\Entity\Joueur;
use Application\Sonata\UserBundle\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Joueur controller.
 *
 * @Route("joueur")
 */
class JoueurController extends Controller
{
    /**
     * Lists all joueur entities.
     *
     * @Route("/", name="joueur_index")
     * @Method("GET")
     */
    public function indexAction(Entity\User $joueur)
    {
        $em = $this->getDoctrine()->getManager();
        $joueur = $this->getJoueurs();

        $joueurs = $em->getRepository('GoFlashBundle:Joueur')->findBy($joueur);

        return $this->render('@GoFlash/joueur/index.html.twig', array(
            'joueurs' => $joueurs,
        ));
    }

    /**
     * Creates a new joueur entity.
     *
     * @Route("/{id}/new", name="joueur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Jeu $jeu)
    {
        $joueur = new Joueur;
        // appel de l'id du user pour insertion dans table joueur
        $joueur->addUser($this->getUser());

        // appel de l'id de jeu pour insertion dans table joueur
        $joueur->addJeux($jeu);
        $em = $this->getDoctrine()->getManager();
        $em->persist($joueur);
        $em->flush();

        return $this->redirectToRoute('joueur_edit', array('id' => $joueur->getId()));
    }

    /**
     * Finds and displays a joueur entity.
     *
     * @Route("/{id}", name="joueur_show")
     * @Method("GET")
     */
    public function showAction(Joueur $joueur)
    {
        //$deleteForm = $this->createDeleteForm($joueur);

        return $this->render('@GoFlash/joueur/show.html.twig', array(
            'joueur' => $joueur,
        ));
    }

    /**
     * Displays a form to edit an existing joueur entity.
     *
     * @Route("/{id}/edit", name="joueur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Joueur $joueur)
    {
        $editForm = $this->createForm('GoFlashBundle\Form\JoueurType', $joueur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $joueur->preUpload();
            $joueur->upload();
            $em = $this->getDoctrine()->getManager();
            $em->persist($joueur);
            $em->flush();

            $this->addFlash(
                'success',
                'La capture du jeu "'.$joueur->getJeux().'" est envoyée au meneur pour validation'
            );

            return $this->redirectToRoute('accueil');
        }

        return $this->render('@GoFlash/joueur/edit.html.twig', array(
            'joueur' => $joueur,
            'edit_form' => $editForm->createView(),
        ));
    }
}
