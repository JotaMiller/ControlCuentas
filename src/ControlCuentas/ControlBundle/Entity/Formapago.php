<?php
namespace ControlCuentas\ControlBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Formapago
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="string", nullable=false)
     */
    private $nombre;

    /** 
     * @ORM\Column(type="text", nullable=true)
     */
    private $descripcion;

    /** 
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Cuota", mappedBy="formapago")
     */
    private $cuotas;

    /** 
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Usuario", inversedBy="formapagos")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     */
    private $usuario;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cuotas = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Formapago
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
     * @return Formapago
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
     * @return Formapago
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
     * @return Formapago
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
}