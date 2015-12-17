<?php

namespace SonodigestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Categoria
 *
 * @ORM\Table(name="galeriaimagenes")
 * @ORM\Entity
 */
class GaleriaImagenes
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
     * @ORM\Column(name="foto", type="string", length=100, nullable=true)
     */
    private $nombre;

   
    /**
     * @var \Consulta
     *
     * @ORM\ManyToOne(targetEntity="CategoriaImagen", inversedBy="imagenes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoriaimagen", referencedColumnName="id")
     * })
     */
    private $idcategoria;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
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
    
    
    
    
    /**
     * Sets fileAntes.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file= null)
    {
        $this->file= $file;
    }

    /**
     * Get fileAntes.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }
    
    
    
    /**
     * Set consulta
     *
     * @param \SonodigestBundle\Entity\CategoriaImagen $idcategoria
     *
     * @return HistorialConsulta
     */
    public function setIdcategoria(\SonodigestBundle\Entity\CategoriaImagen $idcategoria = null)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get consulta
     *
     * @return \DGPlusbelleBundle\Entity\Consulta
     */
    public function getIdCategoria()
    {
        return $this->idcategoria;
    }
    
}
