<?php

namespace App\Entity;

use App\Repository\SettlingRoomRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SettlingRoomRepository::class)
 */
class SettlingRoom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $SetDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $DepartureDate;

    /**
     * @ORM\ManyToOne(targetEntity=Rooms::class, inversedBy="settlingRooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $RoomNum;

    /**
     * @ORM\OneToOne(targetEntity=Guests::class, inversedBy="settlingRoom", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $PassportNum;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->SetDate->format('Y-m-d H:i:s');
    }

    public function getSetDate(): ?\DateTimeInterface
    {
        return $this->SetDate;
    }

    public function setSetDate(\DateTimeInterface $SetDate): self
    {
        $this->SetDate = $SetDate;

        return $this;
    }

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->DepartureDate;
    }

    public function setDepartureDate(?\DateTimeInterface $DepartureDate): self
    {
        $this->DepartureDate = $DepartureDate;

        return $this;
    }

    public function getRoomNum(): ?Rooms
    {
        return $this->RoomNum;
    }

    public function setRoomNum(?Rooms $RoomNum): self
    {
        $this->RoomNum = $RoomNum;

        return $this;
    }

    public function getPassportNum(): ?Guests
    {
        return $this->PassportNum;
    }

    public function setPassportNum(Guests $PassportNum): self
    {
        $this->PassportNum = $PassportNum;

        return $this;
    }
}
