<?php

namespace ControlCuentas\ControlBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Cuentafija
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cuentafija
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255,nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text",nullable=true)
     */
    private $descripcion;
    
    /**
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Usuario", inversedBy="cuentasfijas")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=false)
     */
    private $usuario;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", options={"default":true})
     */
    private $activo;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"nombre"})
     * @ORM\Column(name="slug", type="string", length=128)
     */
    private $slug;
    
    /**
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Categoria", inversedBy="cuentasfijas")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=false)
     */
    private $categoria;
    
    /**
     * @ORM\Column(type="bigint", nullable=false)
     */
    private $monto;
    
    /**
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Tipocuenta", inversedBy="cuentasfijas")
     * @ORM\JoinColumn(name="tipocuenta_id", referencedColumnName="id", nullable=false)
     */
    private $tipocuenta;


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
     * @return Cuentafija
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
     * @return Cuentafija
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
     * Set activo
     *
     * @param boolean $activo
     * @return Cuentafija
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    
        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Cuentafija
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set usuario
     *
     * @param \ControlCuentas\ControlBundle\Entity\Usuario $usuario
     * @return Cuentafija
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
     * @return Cuentafija
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
     * Set monto
     *
     * @param integer $monto
     * @return Cuentafija
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;
    
        return $this;
    }

    /**
     * Get monto
     *
     * @return integer 
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set tipocuenta
     *
     * @param \ControlCuentas\ControlBundle\Entity\Tipocuenta $tipocuenta
     * @return Cuentafija
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