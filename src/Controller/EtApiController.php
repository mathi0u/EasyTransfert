<?php

namespace App\Controller;

use JMS\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtApiController extends AbstractController
{
    /**
     * @Route("/et/api", name="et_api")
     */
    public function index(SerializerInterface $serializer)
    {
        $Medecin = new Medecin();
        $Medecin->setName('iPhone X');
        $Medecin->setPrice(1000);
        $Medecin->setColor('Noir');
        $Medecin->setDescription('Un superbe iphone');

        $data = $serializer->serialize($Medecin, 'json');
        return new JsonResponse($data);
    }
}
