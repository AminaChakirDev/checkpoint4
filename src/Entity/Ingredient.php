<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient
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
    private $IngredientName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $IngredientPoster;

    /**
     * @ORM\ManyToMany(targetEntity=Recipe::class, inversedBy="Ingredients")
     */
    private $Recipes;

    public function __construct()
    {
        $this->Recipes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIngredientName(): ?string
    {
        return $this->IngredientName;
    }

    public function setIngredientName(string $IngredientName): self
    {
        $this->IngredientName = $IngredientName;

        return $this;
    }

    public function getIngredientPoster(): ?string
    {
        return $this->IngredientPoster;
    }

    public function setIngredientPoster(?string $IngredientPoster): self
    {
        $this->IngredientPoster = $IngredientPoster;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->Recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->Recipes->contains($recipe)) {
            $this->Recipes[] = $recipe;
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->Recipes->contains($recipe)) {
            $this->Recipes->removeElement($recipe);
        }

        return $this;
    }
}
