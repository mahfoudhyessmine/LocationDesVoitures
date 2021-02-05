<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30 ,unique=true )
     */
    private $Matricule;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $Marque;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Couleur;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $Carburent;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Nbdeplace;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Disponiibilite;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datemiseencirculation;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="voitures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idagence;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="voiture", orphanRemoval=true)
     */
    private $contrats;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="voitures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
    }

    
    

    
   
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->Matricule;
    }

    public function setMatricule(string $Matricule): self
    {
        $this->Matricule = $Matricule;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->Marque;
    }

    public function setMarque(?string $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->Couleur;
    }

    public function setCouleur(string $Couleur): self
    {
        $this->Couleur = $Couleur;

        return $this;
    }

    public function getCarburent(): ?string
    {
        return $this->Carburent;
    }

    public function setCarburent(?string $Carburent): self
    {
        $this->Carburent = $Carburent;

        return $this;
    }

    public function getNbdeplace(): ?string
    {
        return $this->Nbdeplace;
    }

    public function setNbdeplace(string $Nbdeplace): self
    {
        $this->Nbdeplace = $Nbdeplace;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getDisponiibilite(): ?bool
    {
        return $this->Disponiibilite;
    }

    public function setDisponiibilite(bool $Disponiibilite): self
    {
        $this->Disponiibilite = $Disponiibilite;

        return $this;
    }

    public function getDatemiseencirculation(): ?\DateTimeInterface
    {
        return $this->datemiseencirculation;
    }

    public function setDatemiseencirculation(\DateTimeInterface $datemiseencirculation): self
    {
        $this->datemiseencirculation = $datemiseencirculation;

        return $this;
    }

    public function getIdagence(): ?Agence
    {
        return $this->idagence;
    }

    public function setIdagence(?Agence $idagence): self
    {
        $this->idagence = $idagence;

        return $this;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setVoiture($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getVoiture() === $this) {
                $contrat->setVoiture(null);
            }
        }

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
