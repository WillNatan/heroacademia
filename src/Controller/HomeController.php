<?php

namespace App\Controller;

use App\Entity\Heros;
use App\Repository\HerosRepository;
use App\Repository\MissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/admin", name="admin_home")
     */
    public function admin(MissionRepository $missionRepository, HerosRepository $herosRepository): Response
    {
        $missions = $missionRepository->findBy(['etat'=>0]);

        return $this->render('admin/index.html.twig', ['missions'=> $missions, 'heros'=>$herosRepository->findAll()]);
    }


    /**
     * @Route("/admin/affect-hero/{id}", name="admin_affect")
     */
    public function affectHero(Heros $heros): Response
    {
        $heros->setUser($this->getUser());
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('mission_index');
    }
}
