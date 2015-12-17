<?php

namespace SonodigestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categoria
 *
 * @ORM\Table(name="categoriaimagen")
 * @ORM\Entity
 */
class CategoriaImagen
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
     * @ORM\OneToMany(targetEntity="GaleriaImagenes", mappedBy="idcategoria", cascade={"persist", "remove"})
     */
    private $imagenes;


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
     * @return Categoria
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
    
    function getSubcategoria() {
        return $this->subcategoria;
    }

    function setSubcategoria($subcategoria) {
        $this->subcategoria = $subcategoria;
    }
    
    public function __toString() {
        return $this->nombre;
    }
    
    
    
    
    public function __construct()
    {
        
        $this->imagenes = new ArrayCollection();
        
    }           
    public function getImagenes()
    {
        return $this->imagenes;
    }
    public function setImagenes(\Doctrine\Common\Collections\Collection $imagenes)
    {
        $this->imagenes = $imagenes;
        foreach ($imagenes as $imagen) {
            $imagen->setIdcategoria($this);
        }
    }
    
    public function removeImagen(GaleriaImagenes $imagen)
    {
        $this->imagenes->removeElement($imagen);
    }
    
    
}
