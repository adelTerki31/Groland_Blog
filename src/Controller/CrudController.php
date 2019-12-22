<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Form\ArticleType;

class CrudController extends AbstractController
{
    /**
     * @Route("/crud/create", name="creation")
     */
    public function create(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $article->setCreatedAt(new \DateTime());
            $em->persist($article);
            $em->flush() ;
            return $this->redirectToRoute('blog_show',['id' => $article->getId()]);    
        }

        return $this->render('crud/create.html.twig', [
            'controller_name' => 'CrudController',
            'article_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/crud", name="crud")
     */
    public function index(ArticleRepository $repo)
    {
        $articles = $repo->findAll();

        return $this->render('crud/manager.html.twig', [
            'controller_name' => 'CrudController',
            'articles' => $articles
        ]);
       
    } 

    /**
     * @Route("/crud/read/{id}", name="read")
     */
    public function read($id)
    {   
        return $this->redirectToRoute('blog_show',array('id' => $id));
    }



    /**
     * @Route("/crud/delete/{id}", name="delete")
     */
    public function delete(ArticleRepository $repo,$id)
    {   

        $entityManager = $this->getDoctrine()->getManager();
        $article = $repo->find($id);
        $entityManager->remove($article);
        $entityManager->flush();

        return $this->redirectToRoute('crud');
        
    }

    /**
     * @Route("/crud/edit/{id}", name="edit")
     */
    public function edit($id,Request $request,ArticleRepository $repo)
    {   
        $article = $repo->find($id);
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $article->setCreatedAt(new \DateTime());
            $em->persist($article);
            $em->flush() ;
            return $this->redirectToRoute('blog_show',['id' => $article->getId()]);    
        }

        return $this->render('crud/edit.html.twig', [
            'controller_name' => 'CrudController',
            'article_form' => $form->createView()
        ]);


    }



}
