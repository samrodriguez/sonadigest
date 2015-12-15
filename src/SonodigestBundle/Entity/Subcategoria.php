<?php

namespace SonodigestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Subcategoria
 *
 * @ORM\Table(name="subcategoria", indexes={@ORM\Index(name="fk_subcategoria_categoria1_idx", columns={"idCategoria"})})
 * @ORM\Entity
 */
class Subcategoria
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
     * @ORM\Column(name="nombre", type="string", length=100, nullable=true)
     */
    private $nombre;

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
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="subcategoria", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategoria", referencedColumnName="id")
     * })
     */
    private $idcategoria;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Problema", inversedBy="idsubcategoria")
     * @ORM\JoinTable(name="problema_subcategoria",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idsubcategoria", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idproblema", referencedColumnName="id")
     *   }
     * )
     */
    private $idproblema;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idproblema = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Subcategoria
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Subcategoria
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
     * @return Subcategoria
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
     * @return Subcategoria
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
     * Set idcategoria
     *
     * @param \SonodigestBundle\Entity\Categoria $idcategoria
     *
     * @return Subcategoria
     */
    public function setIdcategoria(\SonodigestBundle\Entity\Categoria $idcategoria = null)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get idcategoria
     *
     * @return \SonodigestBundle\Entity\Categoria
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * Add idproblema
     *
     * @param \SonodigestBundle\Entity\Problema $idproblema
     *
     * @return Subcategoria
     */
    public function addIdproblema(\SonodigestBundle\Entity\Problema $idproblema)
    {
        $this->idproblema[] = $idproblema;

        return $this;
    }

    /**
     * Remove idproblema
     *
     * @param \SonodigestBundle\Entity\Problema $idproblema
     */
    public function removeIdproblema(\SonodigestBundle\Entity\Problema $idproblema)
    {
        $this->idproblema->removeElement($idproblema);
    }

    /**
     * Get idproblema
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdproblema()
    {
        return $this->idproblema;
    }
    
    public function __toString() {
        return $this->nombre."";
    }
}
