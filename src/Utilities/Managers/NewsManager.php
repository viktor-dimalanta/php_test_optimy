<?php

namespace App\Utilities\Managers;

use App\Classes\News;
use App\Utilities\Persistence\DB;
use Tightenco\Collect\Support\Collection;

class NewsManager
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

    /**
     * list all news
     */
    public function listNews(): Collection
    {
        $rows = $this->db->select('SELECT * FROM `news`');

        return collect($rows)->map(function ($row) {
            return (new News())->setId($row['id'])
                ->setTitle($row['title'])
                ->setBody($row['body'])
                ->setCreatedAt($row['created_at']);
        });
    }

    /**
     * add a record in news table
     */
    public function addNews($title, $body): string|false
    {
        $sql = sprintf(
            "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES('%s', '%s', '%s')",
            $title, $body, date('Y-m-d')
        );

        $this->db->exec($sql);

        return $this->db->lastInsertId($sql);
    }

    /**
     * deletes a news, and also linked comments
     */
    public function deleteNews($id): int
    {
        $commentManager = CommentManager::getInstance();
        $listOfComments = collect($commentManager->listComments());

        $listOfComments->map(function ($comment) use ($id, $commentManager) {
            if ($comment->getNewsId() === $id) {
                $commentManager->deleteComment($id);
            }
        });

        $sql = sprintf(
            "DELETE FROM `news` WHERE `id`=%d",
            $id
        );

        return $this->db->exec($sql);
    }
}