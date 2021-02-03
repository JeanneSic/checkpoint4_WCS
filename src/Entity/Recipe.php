<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="text")
     */
    private $ingredients;

    /**
     * @ORM\Column(type="time")
     */
    private $timeOfPreparation;

    /**
     * @ORM\Column(type="text")
     */
    private $instruction;

    /**
     * @ORM\Column(type="text")
     */
    private $kitchenUtensil;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfPerson;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=difficulty::class, inversedBy="recipeType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $difficulty;

    /**
     * @ORM\ManyToOne(targetEntity=recipeType::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipeType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getTimeOfPreparation(): ?\DateTimeInterface
    {
        return $this->timeOfPreparation;
    }

    public function setTimeOfPreparation(\DateTimeInterface $timeOfPreparation): self
    {
        $this->timeOfPreparation = $timeOfPreparation;

        return $this;
    }

    public function getInstruction(): ?string
    {
        return $this->instruction;
    }

    public function setInstruction(string $instruction): self
    {
        $this->instruction = $instruction;

        return $this;
    }

    public function getKitchenUtensil(): ?string
    {
        return $this->kitchenUtensil;
    }

    public function setKitchenUtensil(string $kitchenUtensil): self
    {
        $this->kitchenUtensil = $kitchenUtensil;

        return $this;
    }

    public function getNumberOfPerson(): ?int
    {
        return $this->numberOfPerson;
    }

    public function setNumberOfPerson(int $numberOfPerson): self
    {
        $this->numberOfPerson = $numberOfPerson;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDifficulty(): ?difficulty
    {
        return $this->difficulty;
    }

    public function setDifficulty(?difficulty $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getRecipeType(): ?recipeType
    {
        return $this->recipeType;
    }

    public function setRecipeType(?recipeType $recipeType): self
    {
        $this->recipeType = $recipeType;

        return $this;
    }
}
