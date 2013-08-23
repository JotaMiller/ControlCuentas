<?php
namespace ControlCuentas\ControlBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;

/** 
 * @ORM\Entity
 */
class Documento
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /** 
     * @ORM\ManyToOne(targetEntity="ControlCuentas\ControlBundle\Entity\Cuota", inversedBy="documentos")
     * @ORM\JoinColumn(name="cuota_id", referencedColumnName="id", nullable=false)
     */
    private $cuota;

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
     * Set cuota
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuota $cuota
     * @return Documento
     */
    public function setCuota(\ControlCuentas\ControlBundle\Entity\Cuota $cuota)
    {
        $this->cuota = $cuota;
    
        return $this;
    }

    /**
     * Get cuota
     *
     * @return \ControlCuentas\ControlBundle\Entity\Cuota 
     */
    public function getCuota()
    {
        return $this->cuota;
    }
}