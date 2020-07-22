<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $RecipeTitle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $RecipePoster;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $PreparationTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $CookingTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $NbParts;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Process;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $OnlineDate;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $Level;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $InstaAccount;

    /**
     * @ORM\ManyToMany(targetEntity=Type::class, mappedBy="Recipes")
     */
    private $Types;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, mappedBy="Recipes")
     */
    private $Ingredients;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Slug;

    public function __construct()
    {
        $this->Types = new ArrayCollection();
        $this->Ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipeTitle(): ?string
    {
        return $this->RecipeTitle;
    }

    public function setRecipeTitle(string $RecipeTitle): self
    {
        $this->RecipeTitle = $RecipeTitle;

        return $this;
    }

    public function getRecipePoster(): ?string
    {
        return $this->RecipePoster;
    }

    public function setRecipePoster(?string $RecipePoster): self
    {
        $this->RecipePoster = $RecipePoster;

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->PreparationTime;
    }

    public function setPreparationTime(?int $PreparationTime): self
    {
        $this->PreparationTime = $PreparationTime;

        return $this;
    }

    public function getCookingTime(): ?int
    {
        return $this->CookingTime;
    }

    public function setCookingTime(?int $CookingTime): self
    {
        $this->CookingTime = $CookingTime;

        return $this;
    }

    public function getNbParts(): ?int
    {
        return $this->NbParts;
    }

    public function setNbParts(?int $NbParts): self
    {
        $this->NbParts = $NbParts;

        return $this;
    }

    public function getProcess(): ?string
    {
        return $this->Process;
    }

    public function setProcess(?string $Process): self
    {
        $this->Process = $Process;

        return $this;
    }

    public function getOnlineDate(): ?\DateTimeInterface
    {
        return $this->OnlineDate;
    }

    public function setOnlineDate(?\DateTimeInterface $OnlineDate): self
    {
        $this->OnlineDate = $OnlineDate;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->Level;
    }

    public function setLevel(?int $Level): self
    {
        $this->Level = $Level;

        return $this;
    }

    public function getInstaAccount(): ?string
    {
        return $this->InstaAccount;
    }

    public function setInstaAccount(?string $InstaAccount): self
    {
        $this->InstaAccount = $InstaAccount;

        return $this;
    }

    /**
     * @return Collection|Type[]
     */
    public function getTypes(): Collection
    {
        return $this->Types;
    }

    public function addType(Type $type): self
    {
        if (!$this->Types->contains($type)) {
            $this->Types[] = $type;
            $type->addRecipe($this);
        }

        return $this;
    }

    public function removeType(Type $type): self
    {
        if ($this->Types->contains($type)) {
            $this->Types->removeElement($type);
            $type->removeRecipe($this);
        }

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->Ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->Ingredients->contains($ingredient)) {
            $this->Ingredients[] = $ingredient;
            $ingredient->addRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->Ingredients->contains($ingredient)) {
            $this->Ingredients->removeElement($ingredient);
            $ingredient->removeRecipe($this);
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->Slug;
    }

    public function setSlug(string $Slug): self
    {
        $this->Slug = $Slug;

        return $this;
    }
}
