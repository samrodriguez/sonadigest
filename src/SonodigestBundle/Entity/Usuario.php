<?php

namespace SonodigestBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */
class Usuario implements AdvancedUserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=40, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPersona", referencedColumnName="id")
     * })
     */
    private $persona;

    /**
     * @ORM\ManyToMany(targetEntity="Rol")
     * @ORM\JoinTable(name="rolUsuario",
     *     joinColumns={@ORM\JoinColumn(name="idUsuario", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="idRol", referencedColumnName="id")}
     * )
     */
    private $user_roles;

    private $isEnabled;// = false; 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->user_roles = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
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
     * Set persona
     *
     * @param \SonodigestBundle\Entity\Persona $persona
     *
     * @return Usuario
     */
    public function setPersona(\SonodigestBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \SonodigestBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Add rol
     *
     * @param \SonodigestBundle\Entity\Rol $userRoles
     *
     * @return Usuario
     */
    public function addRol(\SonodigestBundle\Entity\Rol $userRoles)
    {
        $this->user_roles[] = $userRoles;

        return $this;
    }
    
    /**
     * Remove role
     *
     * @param \SonodigestBundle\Entity\Rol $userRoles
     */
    public function removeRole(\SonodigestBundlerol_usuario\Entity\Rol $userRoles)
    {
        $this->user_roles->removeElement($userRoles);
    }

    
    
    public function setUserRoles($roles) {
        $this->user_roles = $roles;
    }

    /**
     * Get user_roles
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getUserRoles()
    {
        return $this->user_roles;
    }
 
    /**
     * Get roles
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->user_roles->toArray(); //IMPORTANTE: el mecanismo de seguridad de Sf2 requiere ésto como un array
    }
    
    /**
     * Compares this user to another to determine if they are the same.
     *
     * @param UserInterface $user The user
     * @return boolean True if equal, false othwerwise.
     */
    public function equals(UserInterface $user) {
        return md5($this->getUsername()) == md5($user->getUsername());
 
    }
 
    /**
     * Erases the user credentials.
     */
    public function eraseCredentials() {
 
    }
    
    /*public function __toString() {
        return $this->username ? $this->username : '';
    }*/
    
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }
    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            ) = unserialize($serialized);
    }
    
    public function isAccountNonExpired()
    {
            return true;
    }

    public function isAccountNonLocked()
    {
            return  !$this->isEnabled;
    }

    public function isCredentialsNonExpired()
    {
            return true;
    }

    public function isEnabled()
    {
        return  $this->isEnabled = true;
    }
    
     public function __toString() {
    return $this->username ? $this->username : '';
    }
}
