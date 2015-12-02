<?php

namespace SonodigestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entrada
 *
 * @ORM\Table(name="entrada", @ORM\Index(name="fk_entrada_categoriablog1_idx", columns={"idCategoria"})})
 * @ORM\Entity
 */
class Entrada
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
     * @ORM\Column(name="titulo", type="string", length=200, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="escritapor", type="string", length=100, nullable=true)
     */
    private $escritapor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=6000, nullable=true)
     */
    private $contenido;
    
    /**
     * @var integer
     *
     *
     * @ORM\OneToOne(targetEntity="Imagenblog", mappedBy="idEntrada", cascade={"persist", "remove"})
     */
    private $idimagen;

    /**
     * @var \Categoriablog
     *
     * @ORM\ManyToOne(targetEntity="Categoriablog")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategoria", referencedColumnName="id")
     * })
     */
    private $idcategoria;



    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Entrada
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * @return Entrada
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
     * Set escritapor
     *
     * @param string $escritapor
     *
     * @return Entrada
     */
    public function setEscritapor($escritapor)
    {
        $this->escritapor = $escritapor;

        return $this;
    }

    /**
     * Get escritapor
     *
     * @return string
     */
    public function getEscritapor()
    {
        return $this->escritapor;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Entrada
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return Entrada
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set idimagen
     *
     * @param \SonodigestBundle\Entity\Imagenblog $idimagen
     *
     * @return Entrada
     */
    public function setIdimagen(\SonodigestBundle\Entity\Imagenblog $idimagen)
    {
        $this->idimagen = $idimagen;

        return $this;
    }

    /**
     * Get idimagen
     *
     * @return \SonodigestBundle\Entity\Imagenblog
     */
    public function getIdimagen()
    {
        return $this->idimagen;
    }

    /**
     * Set idcategoria
     *
     * @param \SonodigestBundle\Entity\Categoriablog $idcategoria
     *
     * @return Entrada
     */
    public function setIdcategoria(\SonodigestBundle\Entity\Categoriablog $idcategoria = null)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get idcategoria
     *
     * @return \SonodigestBundle\Entity\Categoriablog
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }
    
    public function __toString() {
        return $this;
    }
}
