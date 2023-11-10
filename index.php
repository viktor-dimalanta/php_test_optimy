<?php

use App\Utilities\Managers\CommentManager;
use App\Utilities\Managers\NewsManager;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$commentManager = CommentManager::getInstance();
$newsManager = NewsManager::getInstance();
$comments = $commentManager->listComments();

// Add comment for news
//$commentManager->addCommentForNews('sample news', 10);

// Delete comment
//$commentManager->deleteComment(16);

// Add news
//$newsManager->addNews('sample title', 'sample body');

// Delete news
//$newsManager->deleteNews(10);

foreach ($newsManager->listNews() as $news) {
    echo(PHP_EOL);
	echo("############ NEWS " . $news->getTitle() . " ############" . PHP_EOL);
	echo($news->getBody() . PHP_EOL);

	foreach ($comments as $comment) {
		if ($comment->getNewsId() == $news->getId()) {
			echo("Comment " . $comment->getId() . " : " . $comment->getBody() . PHP_EOL);
		}
	}
}
