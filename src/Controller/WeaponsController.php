<?php

namespace App\Controller;

use App\Entity\Weapons;
use App\Form\WeaponsType;
use App\Repository\WeaponsRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/weapons')]
class WeaponsController extends AbstractController
{
    #[Route('/', name: 'app_weapons_index', methods: ['GET'])]
    public function index(WeaponsRepository $weaponsRepository): Response
    {
        return $this->render('weapons/index.html.twig', [
            'weapons' => $weaponsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_weapons_new', methods: ['GET', 'POST'])]
    public function new(Request $request, WeaponsRepository $weaponsRepository): Response
    {
        $weapon = new Weapons();
        $form = $this->createForm(WeaponsType::class, $weapon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weaponsRepository->add($weapon, true);
            $this->addFlash('success','Nouvelle arme créée.');
            return $this->redirectToRoute('app_weapons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('weapons/new.html.twig', [
            'weapon' => $weapon,
            'form' => $form,
        ]);
    }

    #[Route('/addOne/{id}', name: 'app_weapons_addOne', methods: ['GET','POST'])]
    public function addOne(WeaponsRepository $weaponsRepository, ManagerRegistry $doctrine, int $id): Response
    {
         $entityManager = $doctrine->getManager();
         $weapon = $entityManager->getRepository(Weapons::class)->find($id);
         $weapon->setInsightDrop($weapon->getInsightDrop()+1);
         $entityManager->flush();
        $this->addFlash('success','Nouveau drop ajouté.');
        return $this->render('weapons/index.html.twig', [
            'weapons' => $weaponsRepository->findAll(),
        ]);
    }




    #[Route('/{id}/edit', name: 'app_weapons_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Weapons $weapon, WeaponsRepository $weaponsRepository): Response
    {
        $form = $this->createForm(WeaponsType::class, $weapon);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $weaponsRepository->add($weapon, true);
            $this->addFlash('success','Arme modifiée.');
            return $this->redirectToRoute('app_weapons_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('weapons/edit.html.twig', [
            'weapon' => $weapon,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_weapons_delete', methods: ['POST'])]
    public function delete(Request $request, Weapons $weapon, WeaponsRepository $weaponsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$weapon->getId(), $request->request->get('_token'))) {
            $weaponsRepository->remove($weapon, true);
        }

        return $this->redirectToRoute('app_weapons_index', [], Response::HTTP_SEE_OTHER);
    }
}
