<?php

namespace App\Utilities\Managers;

use App\Classes\Comment;
use App\Utilities\Persistence\DB;
use Tightenco\Collect\Support\Collection;

class CommentManager
{
    private static mixed $instance = null;
    private DB $db;

    private function __construct()
    {
        $this->db = DB::getInstance();
    }

    public static function getInstance(): self
    {
        if (null === self::$instance) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    public function listComments(): Collection
    {
        $rows = $this->db->select('SELECT * FROM `comment`');

        return collect($rows)->map(function ($row) {
            return (new Comment())
                ->setId($row['id'])
                ->setBody($row['body'])
                ->setCreatedAt($row['created_at'])
                ->setNewsId($row['news_id']);
        });
    }

    public function addCommentForNews($body, $newsId): string|false
    {
        $sql = sprintf(
            "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES('%s', '%s', '%d')",
            $body, date('Y-m-d'), $newsId
        );

        $this->db->exec($sql);

        return $this->db->lastInsertId($sql);
    }

    public function deleteComment($id): int
    {
        $sql = sprintf(
            "DELETE FROM `comment` WHERE `id`=%d",
            $id
        );

        return $this->db->exec($sql);
    }
}