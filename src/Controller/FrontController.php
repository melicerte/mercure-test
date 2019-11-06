<?php

namespace App\Controller;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @var string
     */
    private $mercureSecretKey;

    public function __construct(string $mercureSecretKey)
    {
        $this->mercureSecretKey = $mercureSecretKey;
    }

    /**
     * @Route("/front/{username}", name="front")
     */
    public function index(string $username)
    {
        // Generate token
        $token = (new Builder())
            ->withClaim('mercure', ['subscribe' => ["http://localhost/user/$username"]])
            ->getToken(new Sha256(), new Key($this->mercureSecretKey));

        $response = new Response();
        $response->headers->setCookie(Cookie::create('mercureAuthorization', $token, 0, '/', 'localhost'));

        return $this->render('front/index.html.twig', [
            'username' => $username,
            'controller_name' => 'FrontController',
        ], $response);
    }
}
