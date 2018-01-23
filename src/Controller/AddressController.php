<?php

namespace App\Controller;

use App\Entity\Address;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    /**
     * @Route("/address", name="address")
     */
    public function index()
    {
        $address = $this->getDoctrine()->getRepository('App:Address')->findAll();

        return $this->render('address/index.html.twig', [
            'addresses' => $address
        ]);
    }

    /**
     * @Route("/address/new", name="addressCreate")
     */
    public function newAction()
    {
        $address = new Address();
        $address->setDescription('Candido Portinari');
        $address->setNumber('120');

        $em = $this->getDoctrine()->getManager();
        $em->persist($address);
        $em->flush();

        return $this->redirectToRoute('address');
    }
}
