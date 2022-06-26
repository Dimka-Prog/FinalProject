<?php

namespace App\Entity;

use App\Repository\RoomsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomsRepository::class)
 */
class Rooms
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
    private $RoomNum;

    /**
     * @ORM\Column(type="integer")
     */
    private $Places;

    /**
     * @ORM\Column(type="integer")
     */
    private $Floor;

    /**
     * @ORM\ManyToOne(targetEntity=RoomType::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TypeID;

    /**
     * @ORM\ManyToOne(targetEntity=HotelStaff::class, inversedBy="rooms")
     */
    private $StaffID;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $RoomStatus;

    /**
     * @ORM\OneToMany(targetEntity=SettlingRoom::class, mappedBy="RoomNum", orphanRemoval=true)
     */
    private $settlingRooms;

    public function __construct()
    {
        $this->settlingRooms = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->RoomStatus;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoomNum(): ?int
    {
        return $this->RoomNum;
    }

    public function setRoomNum(int $RoomNum): self
    {
        $this->RoomNum = $RoomNum;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->Places;
    }

    public function setPlaces(int $Places): self
    {
        $this->Places = $Places;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->Floor;
    }

    public function setFloor(int $Floor): self
    {
        $this->Floor = $Floor;

        return $this;
    }

    public function getTypeID(): ?RoomType
    {
        return $this->TypeID;
    }

    public function setTypeID(?RoomType $TypeID): self
    {
        $this->TypeID = $TypeID;

        return $this;
    }

    public function getStaffID(): ?HotelStaff
    {
        return $this->StaffID;
    }

    public function setStaffID(?HotelStaff $StaffID): self
    {
        $this->StaffID = $StaffID;

        return $this;
    }

    public function getRoomStatus(): ?string
    {
        return $this->RoomStatus;
    }

    public function setRoomStatus(string $RoomStatus): self
    {
        $this->RoomStatus = $RoomStatus;

        return $this;
    }

    /**
     * @return Collection<int, SettlingRoom>
     */
    public function getSettlingRooms(): Collection
    {
        return $this->settlingRooms;
    }

    public function addSettlingRoom(SettlingRoom $settlingRoom): self
    {
        if (!$this->settlingRooms->contains($settlingRoom)) {
            $this->settlingRooms[] = $settlingRoom;
            $settlingRoom->setRoomNum($this);
        }

        return $this;
    }

    public function removeSettlingRoom(SettlingRoom $settlingRoom): self
    {
        if ($this->settlingRooms->removeElement($settlingRoom)) {
            // set the owning side to null (unless already changed)
            if ($settlingRoom->getRoomNum() === $this) {
                $settlingRoom->setRoomNum(null);
            }
        }

        return $this;
    }
}
