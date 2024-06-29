<?php

namespace App\Service;

use App\Entity\Comment;

/**
 * Interface CommentServiceInterface
 *
 * Service interface for managing Comment entities.
 */
interface CommentServiceInterface
{
    /**
     * Get all comments.
     *
     * @return array Array of Comment objects
     */
    public function getAllComments(): array;

    /**
     * Get a comment by its ID.
     *
     * @param int $id The ID of the comment
     * @return Comment|null The Comment object, or null if not found
     */
    public function getCommentById(int $id): ?Comment;

    /**
     * Save a comment.
     *
     * @param Comment $comment The comment to save
     */
    public function save(Comment $comment): void;

    /**
     * Delete a comment.
     *
     * @param Comment $comment The comment to delete
     */
    public function delete(Comment $comment): void;
}
