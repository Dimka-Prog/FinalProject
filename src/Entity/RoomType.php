<?php

namespace App\Entity;

use App\Repository\RoomTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomTypeRepository::class)
 */
class RoomType
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
    private $TypeID;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $RoomType;

    /**
     * @ORM\Column(type="integer")
     */
    private $Price;

    /**
     * @ORM\OneToMany(targetEntity=Rooms::class, mappedBy="TypeID", orphanRemoval=true)
     */
    private $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function __toString(): string
    {
	    return $this->RoomType;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeID(): ?int
    {
        return $this->TypeID;
    }

    public function setTypeID(int $TypeID): self
    {
        $this->TypeID = $TypeID;

        return $this;
    }

    public function getRoomType(): ?string
    {
        return $this->RoomType;
    }

    public function setRoomType(string $RoomType): self
    {
        $this->RoomType = $RoomType;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    /**
     * @return Collection<int, Rooms>
     */
    public function getRooms(): Collection
    {
        return $this->rooms;
    }

    public function addRoom(Rooms $room): self
    {
        if (!$this->rooms->contains($room)) {
            $this->rooms[] = $room;
            $room->setTypeID($this);
        }

        return $this;
    }

    public function removeRoom(Rooms $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getTypeID() === $this) {
                $room->setTypeID(null);
            }
        }

        return $this;
    }
}
