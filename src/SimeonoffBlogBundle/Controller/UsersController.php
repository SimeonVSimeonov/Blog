<?php

namespace SimeonoffBlogBundle\Controller;

use SimeonoffBlogBundle\Entity\User;
use SimeonoffBlogBundle\Form\UserType;
use SimeonoffBlogBundle\Service\Users\UserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends Controller
{
    /**
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    /**
     * UsersController constructor.
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @Route("register", name="user_register", methods={"GET"})
     * @param Request $request
     * @return Response|null
     */
    public function register(Request $request)
    {
        return $this->render("users/register.html.twig", [
            'form' => $this->createForm(UserType::class)->createView()
        ]);
    }

    /**
     * @Route("register", methods={"POST"})
     *
     * @param Request $request
     * @return Response
     */
    public function registerProcess(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        $this->userService->save($user);
        return $this->redirectToRoute('security_login');
    }

    /**
     * @Route("/profile", name="user_profile")
     */
    public function profile(){
        return $this->render("users/profile.html.twig",
            ['user' => $this->userService->currentUser()]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(){

    }
}
