<?php
declare(strict_types=1);


namespace DisasterBundle\Entity;


use DisasterBundle\Dto\DisasterDto;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Fire
 * @package DisasterBundle\Entity
 * @ORM\Entity(repositoryClass="DisasterBundle\Repository\FireRepository")
 */
class Fire extends Disaster
{
    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $brightTI4;

    /**
     * @var float
     * @ORM\Column(type="float", nullable=true)
     */
    private $brightTI5;

    /**
     * @return float
     */
    public function getBrightTI4(): float
    {
        return $this->brightTI4;
    }

    /**
     * @param float $brightTI4
     */
    public function setBrightTI4(float $brightTI4)
    {
        $this->brightTI4 = $brightTI4;
    }

    /**
     * @return float
     */
    public function getBrightTI5(): float
    {
        return $this->brightTI5;
    }

    /**
     * @param float $brightTI5
     */
    public function setBrightTI5(float $brightTI5)
    {
        $this->brightTI5 = $brightTI5;
    }

    /**
     * @return DisasterDto
     */
    public function toDto(): DisasterDto
    {
        $dto = parent::toDto();
        $dto->type = 'Fire';
        return $dto;
    }
}