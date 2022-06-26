<?php

namespace App\Entity;

use App\Repository\HotelStaffRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HotelStaffRepository::class)
 */
class HotelStaff
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
    private $StaffID;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $FIO;

    /**
     * @ORM\Column(type="integer")
     */
    private $Salary;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $WorkShedule;

    /**
     * @ORM\OneToMany(targetEntity=Rooms::class, mappedBy="StaffID")
     */
    private $rooms;

    public function __construct()
    {
        $this->rooms = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->FIO;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStaffID(): ?int
    {
        return $this->StaffID;
    }

    public function setStaffID(int $StaffID): self
    {
        $this->StaffID = $StaffID;

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

    public function getSalary(): ?int
    {
        return $this->Salary;
    }

    public function setSalary(int $Salary): self
    {
        $this->Salary = $Salary;

        return $this;
    }

    public function getWorkShedule(): ?string
    {
        return $this->WorkShedule;
    }

    public function setWorkShedule(string $WorkShedule): self
    {
        $this->WorkShedule = $WorkShedule;

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
            $room->setStaffID($this);
        }

        return $this;
    }

    public function removeRoom(Rooms $room): self
    {
        if ($this->rooms->removeElement($room)) {
            // set the owning side to null (unless already changed)
            if ($room->getStaffID() === $this) {
                $room->setStaffID(null);
            }
        }

        return $this;
    }
}
