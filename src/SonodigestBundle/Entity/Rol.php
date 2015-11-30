<?php

namespace SonodigestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="rol")
 * @ORM\Entity
 */
class Rol
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
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="idrol")
     */
    private $idusuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idusuario = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Rol
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
     * Add idusuario
     *
     * @param \SonodigestBundle\Entity\Usuario $idusuario
     *
     * @return Rol
     */
    public function addIdusuario(\SonodigestBundle\Entity\Usuario $idusuario)
    {
        $this->idusuario[] = $idusuario;

        return $this;
    }

    /**
     * Remove idusuario
     *
     * @param \SonodigestBundle\Entity\Usuario $idusuario
     */
    public function removeIdusuario(\SonodigestBundle\Entity\Usuario $idusuario)
    {
        $this->idusuario->removeElement($idusuario);
    }

    /**
     * Get idusuario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    public function __toString(){return $this->nombre ? $this->nombre : '';}
}
