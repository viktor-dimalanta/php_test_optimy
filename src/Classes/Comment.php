<?php

namespace App\Classes;

class Comment
{
    protected int $id;
    protected string $body;
    protected string $createdAt;
    protected int $newsId;

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setBody($body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getNewsId(): int
    {
        return $this->newsId;
    }

    public function setNewsId($newsId): self
    {
        $this->newsId = $newsId;

        return $this;
    }
}