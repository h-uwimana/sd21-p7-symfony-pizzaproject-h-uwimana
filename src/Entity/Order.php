<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="Order", indexes={@ORM\Index(name="order_pizza_fk", columns={"pizza_id"}), @ORM\Index(name="order_user_fk", columns={"user_id"})})
 * @ORM\Entity
 */
class Order
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $date = 'current_timestamp()';

    /**
     * @var \Pizza
     *
     * @ORM\ManyToOne(targetEntity="Pizza")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pizza_id", referencedColumnName="id")
     * })
     */
    private $pizza;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}
