<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Command
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    private $visitingDay;

    /**
     * @var Client
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="commands", cascade={"persist"})
     */
    private $client;

    /**
     * @var State
     * @ORM\ManyToOne(targetEntity="App\Entity\State", inversedBy="commands", cascade={"persist"})
     */
    private $state;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="command", cascade={"persist"})     *
     */
    private $tickets;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getVisitingDay(): ? \DateTime
    {
        return $this->visitingDay;
    }

    /**
     * @param \DateTime $visitingDay
     */
    public function setVisitingDay(\DateTime $visitingDay): self
    {
        $this->visitingDay = $visitingDay;

        return $this;
    }

    /**
     * @return Client
     */
    public function getClient(): ? Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return State
     */
    public function getState(): ? State
    {
        return $this->state;
    }

    /**
     * @param State $state
     */
    public function setState(State $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setCommand($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->contains($ticket)) {
            $this->tickets->removeElement($ticket);
            // set the owning side to null (unless already changed)
            if ($ticket->getCommand() === $this) {
                $ticket->setCommand(null);
            }
        }

        return $this;
    }
}
