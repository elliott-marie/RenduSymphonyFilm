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

    /**
     * @Route("/realisateurs", name="page_realisateurs")
     */
    public function listActionRea()
    {
        $realisateurs = $this->getDoctrine()->getRepository('renduCinemaBundle:Personne')->findAll();

        $titre_de_la_page = 'Tous les réalisateurs';

        return $this->render(
            'renduCinemaBundle:Realisateur:list.html.twig',
            ['realisateurs' => $realisateurs, 'titre' => $titre_de_la_page]
        );
    }

    /**
     * @Route("/realisateur/{id}", requirements={"id": "\d+"}, name="page_realisateur")
     */
    public function showActionRea($id)
    {
        $realisateur = $this->getDoctrine()->getRepository('renduCinemaBundle:Personne')->find($id);

        return $this->render(
            'renduCinemaBundle:Realisateur:show.html.twig',
            ['realisateur' => $realisateur]
        );
    }

    /**
     * @Route("/realisateur-films/{id}", requirements={"id": "\d+"}, name="page_realisateur-films")
     */
    public function listActionCombi($id)
    {
        $film = $this->getDoctrine()->getRepository('renduCinemaBundle:Film')->findByRealisateur($id);

        $titre_de_la_page = 'Les films de';

        return $this->render(
            'renduCinemaBundle:combinaison:ReaFilm.html.twig',
            ['film' => $film, 'titre' => $titre_de_la_page]
        );
    }

}
