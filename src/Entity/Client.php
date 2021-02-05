<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20 ,unique=true )
     */
    private $n_permi;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $tel;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="client", orphanRemoval=true)
     */
    private $contrats;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="client", orphanRemoval=true)
     */
    private $factures;

    /**
     * @ORM\OneToMany(targetEntity=Voiture::class, mappedBy="client", orphanRemoval=true)
     */
    private $voitures;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
        $this->factures = new ArrayCollection();
        $this->voitures = new ArrayCollection();
    }

   



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNPermi(): ?string
    {
        return $this->n_permi;
    }

    public function setNPermi(string $n_permi): self
    {
        $this->n_permi = $n_permi;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

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
            $contrat->setClient($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getClient() === $this) {
                $contrat->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setClient($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getClient() === $this) {
                $facture->setClient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Voiture[]
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures[] = $voiture;
            $voiture->setClient($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getClient() === $this) {
                $voiture->setClient(null);
            }
        }

        return $this;
    }

    

    
    

}
