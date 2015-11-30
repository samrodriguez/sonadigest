<?php

namespace SonodigestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="fk_usuario_persona_idx", columns={"idPersona"})})
 * @ORM\Entity
 */
class Usuario
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
     * @ORM\Column(name="nombre", type="string", length=30, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=true)
     */
    private $salt;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPersona", referencedColumnName="id")
     * })
     */
    private $idpersona;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rol", inversedBy="idusuario")
     * @ORM\JoinTable(name="rolusuario",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idUsuario", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idRol", referencedColumnName="id")
     *   }
     * )
     */
    private $idrol;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idrol = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Usuario
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
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set idpersona
     *
     * @param \SonodigestBundle\Entity\Persona $idpersona
     *
     * @return Usuario
     */
    public function setIdpersona(\SonodigestBundle\Entity\Persona $idpersona = null)
    {
        $this->idpersona = $idpersona;

        return $this;
    }

    /**
     * Get idpersona
     *
     * @return \SonodigestBundle\Entity\Persona
     */
    public function getIdpersona()
    {
        return $this->idpersona;
    }

    /**
     * Add idrol
     *
     * @param \SonodigestBundle\Entity\Rol $idrol
     *
     * @return Usuario
     */
    public function addIdrol(\SonodigestBundle\Entity\Rol $idrol)
    {
        $this->idrol[] = $idrol;

        return $this;
    }

    /**
     * Remove idrol
     *
     * @param \SonodigestBundle\Entity\Rol $idrol
     */
    public function removeIdrol(\SonodigestBundle\Entity\Rol $idrol)
    {
        $this->idrol->removeElement($idrol);
    }

    /**
     * Get idrol
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdrol()
    {
        return $this->idrol;
    }

     public function __toString(){return $this->nombre ? $this->nombre : '';}
}
