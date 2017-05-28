<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BatteryPack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $batteryPacks = $this->getDoctrine()->getRepository(BatteryPack::class)->getBatteriesStatistics();
        return $this->render('default/index.html.twig', [
            'batteryPacks' => $batteryPacks,
        ]);
    }
}
