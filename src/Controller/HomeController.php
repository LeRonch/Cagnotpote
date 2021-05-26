<?php

namespace App\Controller;

use App\Repository\CampaignRepository;
use App\Repository\ParticipantRepository;
use App\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="home")
     */
    public function index(CampaignRepository $campaignRepository, ParticipantRepository $participantRepository, PaymentRepository $paymentRepository): Response
    {

        $campaigns = $campaignRepository->findAll();
        
        $participants = $participantRepository->FindBy(['campaign_id' => $campaigns]);

        $payments = $paymentRepository->FindBy(['participant_id' => $participants]);
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'campaigns' => $campaigns,
            'participants' => $participants,
            'payments' => $payments,
            
        ]);
    }
    
}
