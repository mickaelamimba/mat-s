<?php

namespace App\Controller;

use App\Entity\Confiscation;
use App\Entity\Material;
use App\Form\ConfiscationType;
use App\Form\MaterialSearchType;
use App\Repository\ConfiscationRepository;
use App\Repository\MaterialRepository;
use App\Search\SearchMaterial;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/material")
 */
class ConfiscationController extends AbstractController
{
    /**
     * @Route("/", name="confiscation_index", methods={"GET"})
     */
    public function index(MaterialRepository $materialRepository,Request $request ): Response
    {
        $search = new SearchMaterial();
        $search->setPage($request->get('page',1));
        $form = $this->createForm(MaterialSearchType::class,$search);

        $form->handleRequest($request);
        return $this->render('confiscation/index.html.twig', [
            'confiscations' => $materialRepository->findAllMaterialAndTypeAndConfiscation($search),
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/new", name="confiscation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $confiscation = new Confiscation();

        $form = $this->createForm(ConfiscationType::class, $confiscation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($confiscation);
            $entityManager->flush();

            return $this->redirectToRoute('confiscation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('confiscation/new.html.twig', [
            'confiscation' => $confiscation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="confiscation_show", methods={"GET"})
     */
    public function show(Confiscation  $confiscation,MaterialRepository $materialRepository): Response

    {


        return $this->render('confiscation/show.html.twig', [
            'confiscation' => $confiscation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="confiscation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Confiscation $confiscation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConfiscationType::class, $confiscation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('confiscation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('confiscation/edit.html.twig', [
            'confiscation' => $confiscation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="confiscation_delete", methods={"POST"})
     */
    public function delete(Request $request, Material $confiscation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$confiscation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($confiscation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('confiscation_index', [], Response::HTTP_SEE_OTHER);
    }
}
