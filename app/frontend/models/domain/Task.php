<?php

namespace frontend\models\domain;
use yii\base\Model;

class Task extends Model
{
    private $id;
    public $name;
    public $description;
    private $creator;
    public $executor;
    public $deadline;
    private $createdAt;
    private $updatedAt;

    public function __construct(array $creatorAttributes, array $attributes = [], array $executorAttributes = [])
    {
        parent::__construct();
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
            $this->creator = $creatorAttributes;
            $this->executor = $executorAttributes;
            $this->createdAt = $attributes["created_at"];
            $this->updatedAt = $attributes["updated_at"];
        }
    }

    public function rules() {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['executor["id"]'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => 'task name',
            'description' => 'Description',
            'executor["id"]' => 'Executor',
            'deadline' => 'Deadline',
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id) {
        return $this->id = $id;
    }

    public function setCreatedAt($createdAt) {
        return $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt) {
        return $this->updatedAt = $updatedAt;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getViewData(): array {
        $lastUpdate = $this->updatedAt;

        if(!$lastUpdate) {
            $lastUpdate = $this->createdAt;
        }

        return [
            'name' => $this->name,
            'description' => $this->description,
            'creator' => $this->creator['name'].' '.$this->creator['surname'],
            'creation date' => $this->createdAt,
            'last update' => $lastUpdate,
        ];
    }

    public function getSaveData(): array {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'creator_id' => $this->creator['id'],
        ];
    }

}