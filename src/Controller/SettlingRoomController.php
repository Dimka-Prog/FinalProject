<?php

namespace App\Controller;

use App\Entity\SettlingRoom;
use App\Form\SettlingRoomType;
use App\Repository\SettlingRoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/settling/room")
 */
class SettlingRoomController extends AbstractController
{
    /**
     * @Route("/", name="app_settling_room_index", methods={"GET"})
     */
    public function index(SettlingRoomRepository $settlingRoomRepository): Response
    {
        return $this->render('settling_room/index.html.twig', [
            'settling_rooms' => $settlingRoomRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_settling_room_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SettlingRoomRepository $settlingRoomRepository): Response
    {
        $settlingRoom = new SettlingRoom();
        $form = $this->createForm(SettlingRoomType::class, $settlingRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $settlingRoomRepository->add($settlingRoom, true);

            return $this->redirectToRoute('app_settling_room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('settling_room/new.html.twig', [
            'settling_room' => $settlingRoom,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_settling_room_show", methods={"GET"})
     */
    public function show(SettlingRoom $settlingRoom): Response
    {
        return $this->render('settling_room/show.html.twig', [
            'settling_room' => $settlingRoom,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_settling_room_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SettlingRoom $settlingRoom, SettlingRoomRepository $settlingRoomRepository): Response
    {
        $form = $this->createForm(SettlingRoomType::class, $settlingRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $settlingRoomRepository->add($settlingRoom, true);

            return $this->redirectToRoute('app_settling_room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('settling_room/edit.html.twig', [
            'settling_room' => $settlingRoom,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_settling_room_delete", methods={"POST"})
     */
    public function delete(Request $request, SettlingRoom $settlingRoom, SettlingRoomRepository $settlingRoomRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$settlingRoom->getId(), $request->request->get('_token'))) {
            $settlingRoomRepository->remove($settlingRoom, true);
        }

        return $this->redirectToRoute('app_settling_room_index', [], Response::HTTP_SEE_OTHER);
    }
}
