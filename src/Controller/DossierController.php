<?php

namespace App\Controller;

use App\Entity\Dossier;
use App\Entity\DossierAddress;
use App\Entity\DossierCard;
use App\Form\DossierType;
use App\Repository\DossierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Requests\DossierRequest;

class DossierController extends AbstractController
{
    /**
     * @Route("/", name="dossier_index", methods={"GET"})
     */
    public function index(DossierRepository $dossierRepository): Response
    {
        return $this->render('dossier/index.html.twig', [
            'dossiers' => $dossierRepository->findBy(['is_active' => true]),
        ]);
    }

    private function saveDossier(Dossier $dossier, DossierRequest $dossierRequest)
    {
        $entityManager = $this->getDoctrine()->getManager();

        if ( ! $dossier->getId()) {
            $dossier->setNumber($dossierRequest->number);
        }

        $dossier->setType($dossierRequest->type);
        $dossier->setName($dossierRequest->name);
        $dossier->setSurname($dossierRequest->surname);

        $dossierAddress = $dossier->getDossierAddresses()->last() ?: new DossierAddress();
        $dossierCard = $dossier->getDossierCards()->last() ?: new DossierCard();

        $dossierAddress->setAddress($dossierRequest->address);

        if ( ! $dossierAddress->getId()) {
            $dossier->addDossierAddress($dossierAddress);
            $entityManager->persist($dossierAddress);
        }

        $dossierCard->setNumber($dossierRequest->card_number);
        $dossierCard->setCvv($dossierRequest->card_cvv);
        
        if ( ! $dossierCard->getId()) {
            $dossier->addDossierCard($dossierCard);
            $entityManager->persist($dossierCard);
        }
        
        if ( ! $dossier->getId()) {
            $entityManager->persist($dossier);
        }
        
        $entityManager->flush();
    }

    /**
     * @Route("/new", name="dossier_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dossier = new Dossier();
        $dossierRequest = new DossierRequest();

        $form = $this->createForm(DossierType::class, $dossierRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveDossier($dossier, $dossierRequest);

            return $this->redirectToRoute('dossier_index');
        }

        return $this->render('dossier/new.html.twig', [
            'dossier' => $dossier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dossier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dossier $dossier): Response
    {
        $dossierRequest = DossierRequest::fromDossier($dossier);

        $form = $this->createForm(DossierType::class, $dossierRequest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveDossier($dossier, $dossierRequest);

            return $this->redirectToRoute('dossier_index');
        }

        return $this->render('dossier/edit.html.twig', [
            'dossier' => $dossier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dossier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dossier $dossier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $dossier->setIsActive(false);
            $entityManager->persist($dossier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dossier_index');
    }
}
