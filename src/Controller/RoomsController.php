<?php

namespace App\Controller;

use App\Entity\Rooms;
use App\Form\RoomsType;
use App\Repository\RoomsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rooms")
 */
class RoomsController extends AbstractController
{
    /**
     * @Route("/", name="app_rooms_index", methods={"GET"})
     */
    public function index(RoomsRepository $roomsRepository): Response
    {
        return $this->render('rooms/index.html.twig', [
            'rooms' => $roomsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_rooms_new", methods={"GET", "POST"})
     */
    public function new(Request $request, RoomsRepository $roomsRepository): Response
    {
        $room = new Rooms();
        $form = $this->createForm(RoomsType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomsRepository->add($room, true);

            return $this->redirectToRoute('app_rooms_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rooms/new.html.twig', [
            'room' => $room,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_rooms_show", methods={"GET"})
     */
    public function show(Rooms $room): Response
    {
        return $this->render('rooms/show.html.twig', [
            'room' => $room,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_rooms_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Rooms $room, RoomsRepository $roomsRepository): Response
    {
        $form = $this->createForm(RoomsType::class, $room);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roomsRepository->add($room, true);

            return $this->redirectToRoute('app_rooms_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rooms/edit.html.twig', [
            'room' => $room,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_rooms_delete", methods={"POST"})
     */
    public function delete(Request $request, Rooms $room, RoomsRepository $roomsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$room->getId(), $request->request->get('_token'))) {
            $roomsRepository->remove($room, true);
        }

        return $this->redirectToRoute('app_rooms_index', [], Response::HTTP_SEE_OTHER);
    }
}
