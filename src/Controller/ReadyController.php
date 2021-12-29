<?php

namespace App\Controller;

use App\Entity\Confiscation;
use App\Entity\Material;
use App\Entity\Ready;
use App\Form\ReadyType;
use App\Repository\MaterialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/affecte")
 */
class ReadyController extends AbstractController
{
    /**
     * @Route("/{id}", name="ready_new",methods={"GET", "POST"})
     */
    public function index(Material $Material,Request $request): Response
    {

        $ready =new Ready();
        $ready->getMateriel()->add($Material);
        $form=  $this->createForm(ReadyType::class,$ready);
        $form->handleRequest($request);
        return $this->render('ready/index.html.twig', [

            'form' => $form->createView(),
        ]);
    }
}
