<?php

namespace rendu\CinemaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="page_accueil")
     */
    public function indexAction()
    {
        return $this->render('renduCinemaBundle:Default:index.html.twig');
    }

    /**
     * @Route("/films", name="page_films")
     */
    public function listAction()
    {
        $films = $this->getDoctrine()->getRepository('renduCinemaBundle:Film')->findAll();

        $titre_de_la_page = 'Tous les films !';

        return $this->render(
            'renduCinemaBundle:Film:list.html.twig',
            ['films' => $films, 'titre' => $titre_de_la_page]
        );
    }

    /**
     * @Route("/film/{id}", requirements={"id": "\d+"}, name="page_film")
     */
    public function showAction($id)
    {
        $film = $this->getDoctrine()->getRepository('renduCinemaBundle:Film')->find($id);

        return $this->render(
            'renduCinemaBundle:Film:show.html.twig',
            ['film' => $film]
        );
    }
}
