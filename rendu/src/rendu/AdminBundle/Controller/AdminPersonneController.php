<?php

// src/rendu/AdminBundle/Controller/AdminPersonneController.php

namespace rendu\AdminBundle\Controller;

use rendu\CinemaBundle\Entity\Personne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use rendu\AdminBundle\Form\PersonneType;

/**
 * @Route("/admin/realisateur")
 */
class AdminPersonneController extends Controller
{
    /**
     * @Route("/ajout", name="admin_realisateur_ajout")
     */
    public function addAction(Request $request)
    {
        $realisateur = new Personne();
        $form = $this->createForm(PersonneType::class, $realisateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $realisateur = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($realisateur);
            $em->flush();

            return $this->redirectToRoute('admin_realisateur_liste');
        }

        return $this->render(
            'renduAdminBundle:Personne:form.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/liste", name="admin_realisateur_liste")
     */
    public function listAction()
    {
        $realisateurs = $this->getDoctrine()->getRepository('renduCinemaBundle:Personne')->findAll();

        return $this->render(
            'renduAdminBundle:Personne:list.html.twig',
            ['realisateurs' => $realisateurs]
        );
    }

    /**
     * @Route("/modif/{id}", name="admin_realisateur_modif", requirements={"id": "\d+"})
     */
    public function editAction(Request $request, $id)
    {
        $realisateur = $this->getDoctrine()->getRepository('renduCinemaBundle:Personne')->find($id);

        $form = $this->createForm(PersonneType::class, $realisateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $realisateur = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($realisateur);
            $em->flush();

            return $this->redirectToRoute('admin_realisateur_liste');
        }

        return $this->render(
            'renduAdminBundle:Personne:form.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/supprimer/{id}", name="admin_realisateur_supprimer", requirements={"id": "\d+"})
     */
    public function deleteAction($id)
    {
        $realisateur = $this->getDoctrine()->getRepository('renduCinemaBundle:Personne')->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($realisateur);
        $em->flush();

        return $this->redirectToRoute('admin_realisateur_liste');
    }
}