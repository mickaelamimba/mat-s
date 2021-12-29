<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MaterialRepository $materialRepository): Response
    {

        return $this->render('home/index.html.twig', [
            'stocks' => $materialRepository->findAllMaterialByTheirState('STOCK'),
            'readys'=>$materialRepository->findAllMaterialByTheirState('READY'),
            'beingdestroys'=>$materialRepository->findAllMaterialByTheirState('BEINGDESTROY'),

        ]);
    }
}
