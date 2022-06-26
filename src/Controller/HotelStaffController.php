<?php

namespace App\Controller;

use App\Entity\HotelStaff;
use App\Form\HotelStaffType;
use App\Repository\HotelStaffRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hotel/staff")
 */
class HotelStaffController extends AbstractController
{
    /**
     * @Route("/", name="app_hotel_staff_index", methods={"GET"})
     */
    public function index(HotelStaffRepository $hotelStaffRepository): Response
    {
        return $this->render('hotel_staff/index.html.twig', [
            'hotel_staffs' => $hotelStaffRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_hotel_staff_new", methods={"GET", "POST"})
     */
    public function new(Request $request, HotelStaffRepository $hotelStaffRepository): Response
    {
        $hotelStaff = new HotelStaff();
        $form = $this->createForm(HotelStaffType::class, $hotelStaff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hotelStaffRepository->add($hotelStaff, true);

            return $this->redirectToRoute('app_hotel_staff_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hotel_staff/new.html.twig', [
            'hotel_staff' => $hotelStaff,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_hotel_staff_show", methods={"GET"})
     */
    public function show(HotelStaff $hotelStaff): Response
    {
        return $this->render('hotel_staff/show.html.twig', [
            'hotel_staff' => $hotelStaff,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_hotel_staff_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, HotelStaff $hotelStaff, HotelStaffRepository $hotelStaffRepository): Response
    {
        $form = $this->createForm(HotelStaffType::class, $hotelStaff);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hotelStaffRepository->add($hotelStaff, true);

            return $this->redirectToRoute('app_hotel_staff_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hotel_staff/edit.html.twig', [
            'hotel_staff' => $hotelStaff,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_hotel_staff_delete", methods={"POST"})
     */
    public function delete(Request $request, HotelStaff $hotelStaff, HotelStaffRepository $hotelStaffRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotelStaff->getId(), $request->request->get('_token'))) {
            $hotelStaffRepository->remove($hotelStaff, true);
        }

        return $this->redirectToRoute('app_hotel_staff_index', [], Response::HTTP_SEE_OTHER);
    }
}
