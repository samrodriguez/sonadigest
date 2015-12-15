<?php

namespace SonodigestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoriablog
 *
 * @ORM\Table(name="categoriablog")
 * @ORM\Entity
 */
class Categoriablog
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
     * @ORM\Column(name="nombre", type="string", length=200, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Entrada", mappedBy="idcategoria", cascade={"persist", "remove"})
     */
    private $entrada;

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
     * @return Categoriablog
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
    
    public function __toString() {
        return $this->nombre;
    }
    
    
    function getEntrada() {
        return $this->entrada;
    }

    function setEntrada($entrada) {
        $this->entrada= $entrada;
    }
    
}
