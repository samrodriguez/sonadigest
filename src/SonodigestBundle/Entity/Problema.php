<?php

namespace SonodigestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Problema
 *
 * @ORM\Table(name="problema")
 * @ORM\Entity
 */
class Problema
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=100, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=6000, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Subcategoria", inversedBy="idproblema")
     * @ORM\JoinTable(name="problema_subcategoria",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idProblema", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idSubCategoria", referencedColumnName="id")
     *   }
     * )
     */
    private $idsubcategoria;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idsubcategoria = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Problema
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Problema
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Problema
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Add idsubcategorium
     *
     * @param \SonodigestBundle\Entity\Subcategoria $idsubcategorium
     *
     * @return Problema
     */
    public function addIdsubcategorium(\SonodigestBundle\Entity\Subcategoria $idsubcategorium)
    {
        $this->idsubcategoria[] = $idsubcategorium;

        return $this;
    }

    /**
     * Remove idsubcategorium
     *
     * @param \SonodigestBundle\Entity\Subcategoria $idsubcategorium
     */
    public function removeIdsubcategorium(\SonodigestBundle\Entity\Subcategoria $idsubcategorium)
    {
        $this->idsubcategoria->removeElement($idsubcategorium);
    }

    /**
     * Get idsubcategoria
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdsubcategoria()
    {
        return $this->idsubcategoria;
    }

    public function __toString(){return $this->titulo ? $this->titulo : '';}
}
