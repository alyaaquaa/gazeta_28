<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Service\CommentServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to manage comments.
 */
#[\Symfony\Component\Routing\Attribute\Route('/comment')]
class CommentController extends AbstractController
{
    /**
     * Constructor
     *
     * @param CommentServiceInterface $commentService
     */
    public function __construct(private readonly CommentServiceInterface $commentService)
    {
    }

    /**
     * Lists all comments.
     *
     * @return Response
     */
    #[\Symfony\Component\Routing\Attribute\Route('/', name: 'comment_index', methods: ['GET'])]
    public function index(): Response
    {
        $comments = $this->commentService->getAllComments();

        return $this->render('comment/index.html.twig', ['comments' => $comments]);
    }

    /**
     * Creates a new comment.
     *
     * @param Request $request
     * @return Response
     */
    #[\Symfony\Component\Routing\Attribute\Route('/new', name: 'comment_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commentService->save($comment);

            return $this->redirectToRoute('comment_index');
        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Shows a single comment.
     *
     * @param Comment $comment
     * @return Response
     */
    #[\Symfony\Component\Routing\Attribute\Route('/{id}', name: 'comment_show', methods: ['GET'])]
    public function show(Comment $comment): Response
    {
        return $this->render('comment/show.html.twig', ['comment' => $comment]);
    }

    /**
     * Edits an existing comment.
     *
     * @param Request $request
     * @param Comment $comment
     * @return Response
     */
    #[\Symfony\Component\Routing\Attribute\Route('/{id}/edit', name: 'comment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comment $comment): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->commentService->save($comment);

            return $this->redirectToRoute('comment_index');
        }

        return $this->render('comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * Deletes a comment.
     *
     * @param Request $request
     * @param Comment $comment
     * @return Response
     */
    #[\Symfony\Component\Routing\Attribute\Route('/{id}', name: 'comment_delete', methods: ['DELETE'])]
    public function delete(Request $request, Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $this->commentService->delete($comment);
        }

        return $this->redirectToRoute('comment_index');
    }
}
