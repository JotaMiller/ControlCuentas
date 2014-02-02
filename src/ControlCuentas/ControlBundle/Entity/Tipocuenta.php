<?php
namespace ControlCuentas\ControlBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Tipocuenta
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", length=200, nullable=false)
     */
    private $nombre;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;
    
    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $num;

    /** 
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Cuenta", mappedBy="tipocuenta")
     */
    private $cuentas;
    
    /**
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Cuentafija", mappedBy="tipocuenta")
     */
    private $cuentasfijas;
    
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
     * @return Tipocuenta
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
     * Add cuentas
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuenta $cuentas
     * @return Tipocuenta
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tipocuenta
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
     * Set num
     *
     * @param integer $num
     * @return Tipocuenta
     */
    public function setNum($num)
    {
        $this->num = $num;
    
        return $this;
    }

    /**
     * Get num
     *
     * @return integer 
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * Add cuentasfijas
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuentafija $cuentasfijas
     * @return Tipocuenta
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