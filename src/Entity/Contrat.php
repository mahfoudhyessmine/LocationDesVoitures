<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Validator\Mapping\ClassMetadata;


/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 */
class Contrat
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */ 
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datededepart;

    /**
     * @ORM\Column(type="datetime")
    
     */
    private $datederouteur;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voiture;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    

    public function __construct()
    {
        $this->datededepart = new \DateTime();
        $this->datederouteur = new \DateTime('now +1 day');
    }

    
   
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDatededepart(): ?\DateTimeInterface
    {
        return $this->datededepart;
    }

    public function setDatededepart(\DateTimeInterface $datededepart): self
    {
        $this->datededepart = $datededepart;

        return $this;
    }

    public function getDatederouteur(): ?\DateTimeInterface
    {
        return $this->datederouteur;
    }

    public function setDatederouteur(\DateTimeInterface $datederouteur): self
    {
        $this->datederouteur = $datederouteur;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    
    

 
  

 
}
