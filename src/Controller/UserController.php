<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository('App:User')->findAll();

        dump($users);
        die();

        return $this->render('user/index.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/user/new", name="userCreate")
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = new User();

        $addressRepository = $em->getRepository(Address::class);
        $address = $addressRepository->find(1);

        $user->setName('Kevin Pugliese');

        $user->setAddress($address);

        $em->persist($user);
//        $em->persist($address);
        $em->flush();

        return $this->redirectToRoute('user');
    }
}
