<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     *
     * @param PropertyRepository $property_repository
     * @return Response
     */
    public function index(PropertyRepository $property_repository): Response
    {
        $properties = $property_repository->findLatest();
        return $this->render('pages/home.html.twig', [
            'properties' => $properties]);
    }
}