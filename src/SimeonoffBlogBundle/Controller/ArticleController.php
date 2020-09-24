<?php

namespace SimeonoffBlogBundle\Controller;

use SimeonoffBlogBundle\Entity\Article;
use SimeonoffBlogBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ArticleController extends Controller
{
    /**
     * @Route("article/create", name="article_create")
     *
     * @param Request $request
     * @return Response|null
     */
    public function create(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $article->setAuthor($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
        }

        return $this->render("article/create.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/article/{id}", name="article_view")
     *
     * @param $id
     * @return Response|null
     */
    public function viewArticle($id)
    {
        $article = $this->getDoctrine()->getRepository(Article::class)->find($id);

        return $this->render('article/article.html.twig', [
            'article' => $article
        ]);
    }
}
