<?php

namespace frontend\models\domain;

class comment
{
    private $id;
    private $taskId;
    private $author;
    private $subject;
    private $text;
    private $createdAt;
    private $updatedAt;

    public function __construct(array $attributes = [], array $creatorAttributes)
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
            $this->author = $creatorAttributes;
            $this->createdAt = $attributes["created_at"];
            $this->updatedAt = $attributes["updated_at"];
        }
    }

    public function getId(): int {
        return $this->id;
    }

    public function getSubject(): string {
        return $this->subject;
    }

    public function getAttributes(): array {
        $lastUpdate = $this->updatedAt;

        if(!$lastUpdate) {
            $lastUpdate = $this->createdAt;
        }

        return [
            'subject' => $this->subject,
            'text' => $this->text,
            'author' => $this->author['name'].' '.$this->author['surname'],
            'last update' => $lastUpdate,
        ];
    }

}