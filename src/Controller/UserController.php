<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authentication_utils
     * @return Response
     */
    public function login(AuthenticationUtils $authentication_utils): Response
    {
        $error = $authentication_utils->getLastAuthenticationError();
        $last_username = $authentication_utils->getLastUsername();
        return $this->render('auth/login.html.twig', [
            'last_username' => $last_username,
            'error' => $error
        ]);
    }


}