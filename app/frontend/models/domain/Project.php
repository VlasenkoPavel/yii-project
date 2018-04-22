<?php

namespace frontend\models\domain;
use common\models\User;
use yii\base\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property array $creator
 * @property string $createdAt
 * @property string $updatedAt
 */
class Project extends Model
{

    private $id;
    public $name = '';
    public $description ='';
    private $creator;
    private $createdAt;
    private $updatedAt;

    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Project name',
            'description' => 'Description',
        ];
    }

    public function __construct(array $creatorAttributes, array $attributes = [])
    {
        parent::__construct();
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        $this->creator = $creatorAttributes;
        $this->createdAt = $attributes["created_at"];
        $this->updatedAt = $attributes["updated_at"];
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
