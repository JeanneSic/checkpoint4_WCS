<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\File;
use App\Repository\RecipeRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @Vich\Uploadable
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
     * @Vich\UploadableField(mapping="recipe_images", fileNameProperty="image")
     * @var File|null
     * @Assert\Image(
     *     uploadErrorMessage="Une erreur est survenue lors du téléchargement.",
     *     maxSize="20000000",
     *     maxSizeMessage="Votre image est trop grande. Veuillez selectionner une image de moins de 20Mo.",
     *     detectCorrupted=true,
     *     sizeNotDetectedMessage= true,
     *     mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *      },
     *     mimeTypesMessage="Seuls les formats png, jpeg, jpg sont acceptés."
     * )
     */
    private $imageFile;

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
     * @ORM\ManyToOne(targetEntity=RecipeType::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipeTypes;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="createdRecipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=Complexity::class, inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $complexity;

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

    public function getRecipeTypes(): ?RecipeType
    {
        return $this->recipeTypes;
    }

    public function setRecipeTypes(?RecipeType $recipeTypes): self
    {
        $this->recipeTypes = $recipeTypes;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getComplexity(): ?Complexity
    {
        return $this->complexity;
    }

    public function setComplexity(?Complexity $complexity): self
    {
        $this->complexity = $complexity;

        return $this;
    }

    public function setImageFile(File $image = null):Recipe
    {
        $this->imageFile = $image;
        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
}
