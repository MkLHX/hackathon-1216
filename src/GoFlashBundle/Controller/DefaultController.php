<?php

namespace GoFlashBundle\Controller;

use GoFlashBundle\Entity\Joueur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\BrowserKit\Request;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function accueilAction()
    {
        return $this->render('GoFlashBundle::accueil.html.twig');
    }
    /**
     * @Route("/profile/eval", name="listToEval")
     */
    public function listToEvalAction()
    {
        $em = $this->getDoctrine()->getManager();
        $joueurs = $em->getRepository('GoFlashBundle:Joueur')->findAll();
        $jeux = $em->getRepository('GoFlashBundle:Jeu')->findAll();
        return $this->render('GoFlashBundle::listToEval.html.twig', array(
            'user' => $this->getUser(),
            'joueurs' => $joueurs,
            'jeux' => $jeux,
        ));
    }

    /**
     * @Route("/profile/valid/{id}", name="evalValid")
     */
    public function evalValidAction(Joueur $joueur)
    {

    }
    /**
     * @Route("/profile/list", name="listOfYourGame")
     */
    public function listOfYourGameAction()
    {
        $em = $this->getDoctrine()->getManager();
        $joueurs = $em->getRepository('GoFlashBundle:Joueur')->findAll();
        $jeux = $em->getRepository('GoFlashBundle:Jeu')->findAll();
        return $this->render('GoFlashBundle::listOfYourGame.html.twig',array(
            'user'=>$this->getUser(),
            'joueurs' => $joueurs,
            'jeux' => $jeux,
            ));
    }
    /**
     * @Route("/profile/stat", name="stat")
     */
    public function statAction()
    {
        $em = $this->getDoctrine()->getManager();
        $joueurs = $em->getRepository('GoFlashBundle:Joueur')->findAll();
        $jeux = $em->getRepository('GoFlashBundle:Jeu')->findAll();
        return $this->render('GoFlashBundle::stat.html.twig',array(
            'user'=>$this->getUser(),
            'joueurs' => $joueurs,
            'jeux' => $jeux,
            ));
    }
}
