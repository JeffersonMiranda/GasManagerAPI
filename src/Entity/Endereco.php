<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EnderecoRepository")
 */
class Endereco
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $rua;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $complemento;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $cep;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $cidade;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $estado;

    public function getId()
    {
        return $this->id;
    }

    public function getRua(): ?string
    {
        return $this->rua;
    }

    public function setRua(?string $rua): self
    {
        $this->rua = $rua;

        return $this;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function setComplemento(?string $complemento): self
    {
        $this->complemento = $complemento;

        return $this;
    }

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): self
    {
        $this->cep = $cep;

        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(?string $cidade): self
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }
}
