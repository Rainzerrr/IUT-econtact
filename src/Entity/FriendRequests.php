<?php

namespace App\Entity;

use App\Repository\FriendRequestsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FriendRequestsRepository::class)]
class FriendRequests
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $transmitter = null;

    #[ORM\Id]
    #[ORM\Column]
    private ?int $receiver = null;

    public function getTransmitter(): ?int
    {
        return $this->transmitter;
    }

    public function setTransmitter(int $transmitter): self
    {
        $this->transmitter = $transmitter;

        return $this;
    }

    public function getReceiver(): ?int
    {
        return $this->receiver;
    }

    public function setReceiver(int $receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }
}
