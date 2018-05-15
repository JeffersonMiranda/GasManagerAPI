<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClienteRepository")
 */
class Cliente
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Contato", cascade={"persist", "remove"})
     */
    private $Contato;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Endereco", cascade={"persist", "remove"})
     */
    private $Endereco;

    public function getId()
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getContato(): ?Contato
    {
        return $this->Contato;
    }

    public function setContato(?Contato $Contato): self
    {
        $this->Contato = $Contato;

        return $this;
    }

    public function getEndereco(): ?Endereco
    {
        return $this->Endereco;
    }

    public function setEndereco(?Endereco $Endereco): self
    {
        $this->Endereco = $Endereco;

        return $this;
    }

    /**
     * @Assert\IsTrue(message="O nome deve conter mais do que 5 caracteres.")
     */
    public function isNomeMoreThanFiveCharacters(){
        return strlen($this->nome) > 5;
    }

    /**
     * @Assert\IsTrue(message="O campo nome não pode estar vazio.")
     */
    public function isNomeBlank(){
        return !empty($this->nome); // RETURN TRUE IF NAME FIELD IS NOT EMPTY
    }
}
