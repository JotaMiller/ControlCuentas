<?php
namespace ControlCuentas\ControlBundle\Entity;
use Doctrine\ORM\Mapping AS ORM;
use FOS\UserBundle\Model\User as BaseUser;

/** 
 * @ORM\Entity
 */
class Usuario extends BaseUser
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /** 
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Cuenta", mappedBy="usuario")
     */
    private $cuentas;
    
    /**
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Cuentafija", mappedBy="usuario")
     */
    private $cuentasfijas;

    /** 
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Categoria", mappedBy="usuario")
     */
    private $categorias;

    /** 
     * @ORM\OneToMany(targetEntity="ControlCuentas\ControlBundle\Entity\Formapago", mappedBy="usuario")
     */
    private $formapagos;
    
    public function __construct()
    {
        parent::__construct();

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
     * Add cuentas
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuenta $cuentas
     * @return Usuario
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
     * Add categorias
     *
     * @param \ControlCuentas\ControlBundle\Entity\Categoria $categorias
     * @return Usuario
     */
    public function addCategoria(\ControlCuentas\ControlBundle\Entity\Categoria $categorias)
    {
        $this->categorias[] = $categorias;
    
        return $this;
    }

    /**
     * Remove categorias
     *
     * @param \ControlCuentas\ControlBundle\Entity\Categoria $categorias
     */
    public function removeCategoria(\ControlCuentas\ControlBundle\Entity\Categoria $categorias)
    {
        $this->categorias->removeElement($categorias);
    }

    /**
     * Get categorias
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategorias()
    {
        return $this->categorias;
    }

    /**
     * Add formapagos
     *
     * @param \ControlCuentas\ControlBundle\Entity\Formapago $formapagos
     * @return Usuario
     */
    public function addFormapago(\ControlCuentas\ControlBundle\Entity\Formapago $formapagos)
    {
        $this->formapagos[] = $formapagos;
    
        return $this;
    }

    /**
     * Remove formapagos
     *
     * @param \ControlCuentas\ControlBundle\Entity\Formapago $formapagos
     */
    public function removeFormapago(\ControlCuentas\ControlBundle\Entity\Formapago $formapagos)
    {
        $this->formapagos->removeElement($formapagos);
    }

    /**
     * Get formapagos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFormapagos()
    {
        return $this->formapagos;
    }

    /**
     * Add cuentasfijas
     *
     * @param \ControlCuentas\ControlBundle\Entity\Cuentafija $cuentasfijas
     * @return Usuario
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