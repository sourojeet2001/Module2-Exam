<?php

namespace App\Entity;

use App\Repository\TodoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TodoRepository::class)]
class Todo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $itemname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItemname(): ?string
    {
        return $this->itemname;
    }

    public function setItemname(string $itemname): self
    {
        $this->itemname = $itemname;

        return $this;
    }
}
