<?php

namespace SonodigestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Imagenblog
 *
 * @ORM\Table(name="imagenblog")
 * @ORM\Entity
 */
class Imagenblog
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
     * @ORM\Column(name="imagen1", type="string", length=45, nullable=true)
     */
    private $imagen1;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * @var \imagenblog
     *
     * @ORM\ManyToOne(targetEntity="Entrada", inversedBy="idimagen", cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entrada_id", referencedColumnName="id")
     * })
     */
    private $idEntrada;


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
     * Set imagen1
     *
     * @param string $imagen1
     *
     * @return Imagenblog
     */
    public function setImagen1($imagen1)
    {
        $this->imagen1 = $imagen1;

        return $this;
    }

    /**
     * Get imagen1
     *
     * @return string
     */
    public function getImagen1()
    {
        return $this->imagen1;
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
     * Set Entrada
     *
     * @param \SonodigestBundle\Entity\Imagenblog $idEntrada
     *
     * @return Entrada
     */
    public function setIdEntrada(\SonodigestBundle\Entity\Entrada $idEntrada = null)
    {
        $this->idEntrada = $idEntrada;

        return $this;
    }

    /**
     * Get Entrada
     *
     * @return \SonodigestBundle\Entity\Entrada
     */
    public function getIdEntrada()
    {
        return $this->idEntrada;
    }
}
