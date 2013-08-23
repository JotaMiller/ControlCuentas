<?php
namespace ControlCuentas\ControlBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Cuota
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\Column(type="bigint", nullable=false)
     */
    private $monto_pactado;

    /** 
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $monto_pagado;

    /** 
     * @ORM\Column(type="date", nullable=false)
     */
    private $fecha_vencimiento;

    /** 
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_pago;

    /** 
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Documento", mappedBy="cuota")
     */
    private $documentos;

    /** 
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Formapago", inversedBy="cuotas")
     * @ORM\JoinColumn(name="formapago_id", referencedColumnName="id")
     */
    private $formapago;

    /** 
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Cuenta", inversedBy="cuotas")
     * @ORM\JoinColumn(name="cuenta_id", referencedColumnName="id", nullable=false)
     */
    private $cuenta;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documentos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set monto_pactado
     *
     * @param integer $montoPactado
     * @return Cuota
     */
    public function setMontoPactado($montoPactado)
    {
        $this->monto_pactado = $montoPactado;
    
        return $this;
    }

    /**
     * Get monto_pactado
     *
     * @return integer 
     */
    public function getMontoPactado()
    {
        return $this->monto_pactado;
    }

    /**
     * Set monto_pagado
     *
     * @param integer $montoPagado
     * @return Cuota
     */
    public function setMontoPagado($montoPagado)
    {
        $this->monto_pagado = $montoPagado;
    
        return $this;
    }

    /**
     * Get monto_pagado
     *
     * @return integer 
     */
    public function getMontoPagado()
    {
        return $this->monto_pagado;
    }

    /**
     * Set fecha_vencimiento
     *
     * @param \DateTime $fechaVencimiento
     * @return Cuota
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fecha_vencimiento = $fechaVencimiento;
    
        return $this;
    }

    /**
     * Get fecha_vencimiento
     *
     * @return \DateTime 
     */
    public function getFechaVencimiento()
    {
        return $this->fecha_vencimiento;
    }

    /**
     * Set fecha_pago
     *
     * @param \DateTime $fechaPago
     * @return Cuota
     */
    public function setFechaPago($fechaPago)
    {
        $this->fecha_pago = $fechaPago;
    
        return $this;
    }

    /**
     * Get fecha_pago
     *
     * @return \DateTime 
     */
    public function getFechaPago()
    {
        return $this->fecha_pago;
    }

    /**
     * Add documentos
     *
     * @param \ControlCuentas\ControlBundle\Entity\Documento $documentos
     * @return Cuota
     */
    public function addDocumento(\ControlCuentas\ControlBundle\Entity\Documento $documentos)
    {
        $this->documentos[] = $documentos;
    
        return $this;
    }

    /**
     * Remove documentos
     *
     * @param \ControlCuentas\ControlBundle\Entity\Documento $documentos
     */
    public function removeDocumento(\ControlCuentas\ControlBundle\Entity\Documento $documentos)
    {
        $this->documentos->removeElement($documentos);
    }

    /**
     * Get documentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentos()
    {
        return $this->documentos;
    }

    /**
     * Set formapago
     *
     * @param \ControlCuentas\ControlBundle\Entity\Formapago $formapago
     * @return Cuota
     */
    public function setFormapago(\ControlCuentas\ControlBundle\Entity\Formapago $formapago = null)
    {
        $this->formapago = $formapago;
    
        return $this;
    }

    /**
     * Get formapago
     *
     * @return \ControlCuentas\ControlBundle\Entity\Formapago 
     */
    public function getFormapago()
    {
        return $this->formapago;
    }

    /**
     * Set cuenta
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuenta $cuenta
     * @return Cuota
     */
    public function setCuenta(\ControlCuentas\ControlBundle\Entity\Cuenta $cuenta)
    {
        $this->cuenta = $cuenta;
    
        return $this;
    }

    /**
     * Get cuenta
     *
     * @return \ControlCuentas\ControlBundle\Entity\Cuenta 
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }
}