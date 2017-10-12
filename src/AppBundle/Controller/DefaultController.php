<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BatteryPack;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="homepage")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function indexAction()
    {
        $batteryPacks = $this->getEntityManager()->getRepository(BatteryPack::class)->getBatteriesStatistics();
        return $this->render('default/index.html.twig', [
            'batteryPacks' => $batteryPacks,
        ]);
    }
}
