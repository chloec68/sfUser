<?php

namespace App\Entity;

use App\Repository\SoleilRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SoleilRepository::class)]
class Soleil
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $truc = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTruc(): ?string
    {
        return $this->truc;
    }

    public function setTruc(string $truc): static
    {
        $this->truc = $truc;

        return $this;
    }
}
