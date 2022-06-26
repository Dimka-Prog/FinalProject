<?php

namespace App\Controller;

use App\Entity\Guests;
use App\Form\GuestsType;
use App\Repository\GuestsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/guests")
 */
class GuestsController extends AbstractController
{
    /**
     * @Route("/", name="app_guests_index", methods={"GET"})
     */
    public function index(GuestsRepository $guestsRepository): Response
    {
        return $this->render('guests/index.html.twig', [
            'guests' => $guestsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_guests_new", methods={"GET", "POST"})
     */
    public function new(Request $request, GuestsRepository $guestsRepository): Response
    {
        $guest = new Guests();
        $form = $this->createForm(GuestsType::class, $guest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guestsRepository->add($guest, true);

            return $this->redirectToRoute('app_guests_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('guests/new.html.twig', [
            'guest' => $guest,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_guests_show", methods={"GET"})
     */
    public function show(Guests $guest): Response
    {
        return $this->render('guests/show.html.twig', [
            'guest' => $guest,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_guests_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Guests $guest, GuestsRepository $guestsRepository): Response
    {
        $form = $this->createForm(GuestsType::class, $guest);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $guestsRepository->add($guest, true);

            return $this->redirectToRoute('app_guests_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('guests/edit.html.twig', [
            'guest' => $guest,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_guests_delete", methods={"POST"})
     */
    public function delete(Request $request, Guests $guest, GuestsRepository $guestsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$guest->getId(), $request->request->get('_token'))) {
            $guestsRepository->remove($guest, true);
        }

        return $this->redirectToRoute('app_guests_index', [], Response::HTTP_SEE_OTHER);
    }
}
