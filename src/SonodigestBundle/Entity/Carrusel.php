<?php

namespace SonodigestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Carrusel
 *
 * @ORM\Table(name="carrusel")
 * @ORM\Entity
 */
class Carrusel
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
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * @var \tipoCarrusel
     *
     * @ORM\ManyToOne(targetEntity="TipoCarrusel", inversedBy="placas", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_carrusel", referencedColumnName="id")
     * })
     */
    private $tipoCarrusel;
    
 
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
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Imagencarrusel
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
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
     * Set tipoCarrusel
     *
     * @param \SonodigestBundle\Entity\TipoCarrusel $tipoCarrusel
     *
     * @return Carrusel
     */
    public function setTipoCarrusel(\SonodigestBundle\Entity\TipoCarrusel $tipoCarrusel = null)
    {
        $this->tipoCarrusel = $tipoCarrusel;

        return $this;
    }

    /**
     * Get tipoCarrusel
     *
     * @return \SonodigestBundle\Entity\TipoCarrusel
     */
    public function getTipoCarrusel()
    {
        return $this->tipoCarrusel;
    }

}
