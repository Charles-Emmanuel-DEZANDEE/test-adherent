<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 */
class Adherent
{
    private $identifiant;

    private $nom;

    private $prenom;

    private $telephone;

    /**
     * Adherent constructor.
     * @param $identifiant
     * @param $nom
     * @param $prenom
     * @param $telephone
     */
    public function __construct($identifiant, $nom, $prenom, $telephone)
    {
        $this->identifiant = $identifiant;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
    }


    public function getIdentifiant(): ?int
    {
        return $this->identifiant;
    }

    /**
     * @param mixed $identifiant
     * @return Adherent
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;
        return $this;
    }


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }
}
