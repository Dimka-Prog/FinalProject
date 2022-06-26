<?php

namespace App\Entity;

use App\Repository\GuestsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GuestsRepository::class)
 */
class Guests
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $PassportNum;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $FIO;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $CitizenShip;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $TypeGuests;

    /**
     * @ORM\OneToOne(targetEntity=SettlingRoom::class, mappedBy="PassportNum", cascade={"persist", "remove"})
     */
    private $settlingRoom;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->FIO;
    }

    public function getPassportNum(): ?int
    {
        return $this->PassportNum;
    }

    public function setPassportNum(int $PassportNum): self
    {
        $this->PassportNum = $PassportNum;

        return $this;
    }

    public function getFIO(): ?string
    {
        return $this->FIO;
    }

    public function setFIO(string $FIO): self
    {
        $this->FIO = $FIO;

        return $this;
    }

    public function getCitizenShip(): ?string
    {
        return $this->CitizenShip;
    }

    public function setCitizenShip(string $CitizenShip): self
    {
        $this->CitizenShip = $CitizenShip;

        return $this;
    }

    public function getTypeGuests(): ?string
    {
        return $this->TypeGuests;
    }

    public function setTypeGuests(string $TypeGuests): self
    {
        $this->TypeGuests = $TypeGuests;

        return $this;
    }

    public function getSettlingRoom(): ?SettlingRoom
    {
        return $this->settlingRoom;
    }

    public function setSettlingRoom(SettlingRoom $settlingRoom): self
    {
        // set the owning side of the relation if necessary
        if ($settlingRoom->getPassportNum() !== $this) {
            $settlingRoom->setPassportNum($this);
        }

        $this->settlingRoom = $settlingRoom;

        return $this;
    }
}
