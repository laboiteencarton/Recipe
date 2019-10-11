<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StepRepository")
 */
class Step
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $spot;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipe", inversedBy="steps")
     */
    private $Recipes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpot(): ?int
    {
        return $this->spot;
    }

    public function setSpot(int $spot): self
    {
        $this->spot = $spot;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function __toString()
    {
        return $this->description;
    }

    public function getRecipes(): ?Recipe
    {
        return $this->Recipes;
    }

    public function setRecipes(?Recipe $Recipes): self
    {
        $this->Recipes = $Recipes;

        return $this;
    }
}
