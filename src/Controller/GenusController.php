<?php

namespace App\Controller;

use App\Entity\Genus;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{
    /**
     * @Route("/genus", name="list")
     */
    public function index()
    {
        $genus = $this->getDoctrine()->getRepository('App:Genus')->findAll();

        return $this->render('post/index.html.twig', [
            'genus' => $genus
        ]);
    }

    /**
     * @Route("/genus/find/{id}", name="find")
     */
    public function findAction($id)
    {
        $genus = $this->getDoctrine()->getRepository('App:Genus')->findBy([
            'id' => [$id]
        ]);


        return $this->render('post/index.html.twig', [
            'genus' => $genus
        ]);
    }

    /**
     * @Route("/genus/new/{name}", name="create")
     */
    public function newAction($name)
    {
        $genus = new Genus();
        $genus->setName($name);

        $em = $this->getDoctrine()->getManager();
        $em->persist($genus);
        $em->flush();

        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/genus/update/{id}/{name}", name="update")
     */
    public function updateAction($id, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $genus = $em->getRepository('App:Genus')->find($id);
        $genus->setName($name);
        $em->flush();

        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/genus/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $genus = $em->getRepository('App:Genus')->find($id);
        $em->remove($genus);
        $em->flush();

        return $this->redirectToRoute('list');
    }
}
