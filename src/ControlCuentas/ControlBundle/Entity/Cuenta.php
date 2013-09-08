<?php
namespace ControlCuentas\ControlBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="ControlCuentas\ControlBundle\Entity\CuentaRepository")
 */
class Cuenta
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
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Cuota", mappedBy="cuenta")
     */
    private $cuotas;

    /** 
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Usuario", inversedBy="cuentas")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     */
    private $usuario;

    /** 
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Categoria", inversedBy="cuentas")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=false)
     */
    private $categoria;

    /** 
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Tipocuenta", inversedBy="cuentas")
     * @ORM\JoinColumn(name="tipocuenta_id", referencedColumnName="id", nullable=false)
     */
    private $tipocuenta;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cuotas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Cuenta
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
     * @return Cuenta
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
     * Add cuotas
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuota $cuotas
     * @return Cuenta
     */
    public function addCuota(\ControlCuentas\ControlBundle\Entity\Cuota $cuotas)
    {
        $this->cuotas[] = $cuotas;
    
        return $this;
    }

    /**
     * Remove cuotas
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuota $cuotas
     */
    public function removeCuota(\ControlCuentas\ControlBundle\Entity\Cuota $cuotas)
    {
        $this->cuotas->removeElement($cuotas);
    }

    /**
     * Get cuotas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCuotas()
    {
        return $this->cuotas;
    }

    /**
     * Set usuario
     *
     * @param \ControlCuentas\ControlBundle\Entity\Usuario $usuario
     * @return Cuenta
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
     * Set categoria
     *
     * @param \ControlCuentas\ControlBundle\Entity\Categoria $categoria
     * @return Cuenta
     */
    public function setCategoria(\ControlCuentas\ControlBundle\Entity\Categoria $categoria)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \ControlCuentas\ControlBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set tipocuenta
     *
     * @param \ControlCuentas\ControlBundle\Entity\Tipocuenta $tipocuenta
     * @return Cuenta
     */
    public function setTipocuenta(\ControlCuentas\ControlBundle\Entity\Tipocuenta $tipocuenta)
    {
        $this->tipocuenta = $tipocuenta;
    
        return $this;
    }

    /**
     * Get tipocuenta
     *
     * @return \ControlCuentas\ControlBundle\Entity\Tipocuenta 
     */
    public function getTipocuenta()
    {
        return $this->tipocuenta;
    }
}