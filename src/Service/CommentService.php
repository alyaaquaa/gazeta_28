<?php

namespace App\Service;

use App\Entity\Comment;
use App\Repository\CommentRepository;

/**
 * Class CommentService
 *
 * Service class implementing CommentServiceInterface to manage Comment entities.
 */
class CommentService implements CommentServiceInterface
{
    /**
     * Constructor.
     *
     * @param CommentRepository $commentRepository The comment repository
     */
    public function __construct(private readonly CommentRepository $commentRepository)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getAllComments(): array
    {
        return $this->commentRepository->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function getCommentById(int $id): ?Comment
    {
        return $this->commentRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function save(Comment $comment): void
    {
        $this->commentRepository->save($comment, true);
    }

    /**
     * {@inheritdoc}
     */
    public function delete(Comment $comment): void
    {
        $this->commentRepository->remove($comment, true);
    }
}
