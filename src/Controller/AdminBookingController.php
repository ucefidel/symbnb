<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Form\AdminBookingType;
use App\Service\PaginationService;
use App\Repository\BookingRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminBookingController extends AbstractController
{
    /**
     * @Route("/admin/bookings/{page<\d+>?1}", name="admin_booking_index")
     */
    public function index(BookingRepository $repo,$page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Booking::class)
                   ->setPage($page)
        ;
   
        return $this->render('admin/booking/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    /**
     * Permet de modifier une réservation
     * 
     * @Route("/admin/bookings/{id}/edit", name="admin_booking_edit")
     *
     * @param ObjectManager $manager
     * @param Request $request
     * @param Booking $booking
     * @return Response
     * 
     */
    public function edit(ObjectManager $manager, Request $request, Booking $booking){

        $form = $this->createForm(AdminBookingType::class,$booking);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $booking->setAmount(0);

            $manager->persist($booking);
            $manager->flush();

            $this->addFlash(
                'success',
                "La réservation n° {$booking->getId()} a été modifié avec succée"
            );

            return $this->redirectToRoute('admin_booking_index');
        }

        return $this->render('admin/booking/edit.html.twig',[
            'form' => $form->createView(),
            'booking' => $booking
        ]);
    }

    /**
     * Permet de supprimer une réservation
     * 
     * @Route("/admin/bookings/{id}/delete", name="admin_booking_delete")
     *
     * @return Response
     */
    public function delete(ObjectManager $manager, Booking $booking){
        $manager->remove($booking);
        $manager->flush();

        $this->addFlash(
            'success',
            "La réservation à été supprimée avec succée"
        );

        return $this->redirectToRoute('admin_booking_index');
    }
}
