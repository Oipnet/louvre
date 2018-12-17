<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Client
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="tickets", cascade={"persist"})
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Price", inversedBy="tickets", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $price;

    /**
     * @var Command
     * @ORM\ManyToOne(targetEntity="App\Entity\Command", inversedBy="tickets")
     */
    private $command;

    public function __construct()
    {
        $this->price = new Price();
        $this->price->setAmount(1000);
        $this->price->setLabel('Temp fix');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?Price
    {
        return $this->price;
    }

    public function setPrice(?Price $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Client
     */
    public function getClient(): ?Client
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


}
