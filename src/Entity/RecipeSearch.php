<?php

namespace App\Entity;

use App\Repository\RecipeSearchRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeSearchRepository::class)
 */
class RecipeSearch
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $recipeType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complexity;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfPerson;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipeType(): ?string
    {
        return $this->recipeType;
    }

    public function setRecipeType(?string $recipeType): self
    {
        $this->recipeType = $recipeType;

        return $this;
    }

    public function getComplexity(): ?string
    {
        return $this->complexity;
    }

    public function setComplexity(?string $complexity): self
    {
        $this->complexity = $complexity;

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
}
