<?php
namespace ControlCuentas\ControlBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Categoria
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $nombre;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /** 
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Cuenta", mappedBy="categoria")
     */
    private $cuentas;
    
    /**
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Cuentafija", mappedBy="categoria")
     */
    private $cuentasfijas;

    /** 
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Usuario", inversedBy="categorias")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     */
    private $usuario;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cuentas = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function __toString()
    {
        return $this->nombre;
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Categoria
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
     * Add cuentas
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuenta $cuentas
     * @return Categoria
     */
    public function addCuenta(\ControlCuentas\ControlBundle\Entity\Cuenta $cuentas)
    {
        $this->cuentas[] = $cuentas;
    
        return $this;
    }

    /**
     * Remove cuentas
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuenta $cuentas
     */
    public function removeCuenta(\ControlCuentas\ControlBundle\Entity\Cuenta $cuentas)
    {
        $this->cuentas->removeElement($cuentas);
    }

    /**
     * Get cuentas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCuentas()
    {
        return $this->cuentas;
    }

    /**
     * Set usuario
     *
     * @param \ControlCuentas\ControlBundle\Entity\Usuario $usuario
     * @return Categoria
     */
    public function setUsuario(\ControlCuentas\ControlBundle\Entity\Usuario $usuario)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \ControlCuentas\ControlBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add cuentasfijas
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuentafija $cuentasfijas
     * @return Categoria
     */
    public function addCuentasfija(\ControlCuentas\ControlBundle\Entity\Cuentafija $cuentasfijas)
    {
        $this->cuentasfijas[] = $cuentasfijas;
    
        return $this;
    }

    /**
     * Remove cuentasfijas
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuentafija $cuentasfijas
     */
    public function removeCuentasfija(\ControlCuentas\ControlBundle\Entity\Cuentafija $cuentasfijas)
    {
        $this->cuentasfijas->removeElement($cuentasfijas);
    }

    /**
     * Get cuentasfijas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCuentasfijas()
    {
        return $this->cuentasfijas;
    }
}