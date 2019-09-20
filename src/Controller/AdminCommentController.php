<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Form\AdminCommentType;
use App\Service\PaginationService;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCommentController extends AbstractController
{
    /**
     * @Route("/admin/comments/{page<\d+>?1}", name="admin_comment_index")
     */
    public function index(CommentRepository $repo,$page, PaginationService $pagination)
    {
        $pagination->setEntityClass(Comment::class)
                   ->setPage($page)
        ;
   
        return $this->render('admin/comment/index.html.twig', [
            'pagination' => $pagination
        ]);
    }
    
    /**
     * Permet de modifier un commentaire
     * 
     * @Route("/admin/comment/{id}/edit", name="admin_comment_edit")
     *
     * @param ObjectManager $manager
     * @param Comment $comment
     * @return Response
     */
    public function edit(ObjectManager $manager, Comment $comment, Request $request){
        $form = $this->createForm(AdminCommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire a été modifié avec succée"
            );
        }

        return $this->render('admin/comment/edit.html.twig',[
            'form'    => $form->createView(),
            'comment' => $comment
        ]);
    }

    /**
     * Permet de supprimer un commentaire
     * 
     * @Route("admin/comments/{id}/delete", name="admin_comment_delete")
     *
     * @param Comment $comment
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Comment $comment, ObjectManager $manager){
        
        $manager->remove($comment);
        $manager->flush();

        $this->addFlash(
            'success',
            "Votre commentaire de {$comment->getAuthor()->getFullName()} été supprimée avec succée"
        );

        return $this->redirectToRoute('admin_comment_index');
    }
}
