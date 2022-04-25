<?php

namespace VPyatin\Bundle\CoreBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use \VPyatin\Bundle\CoreBundle\Entity\Repository\MonobankCurrencyRepository;

/**
 * @ORM\Entity(
 *     repositoryClass=MonobankCurrencyRepository::class
 * )
 * @ORM\Table(name=MonobankCurrencyInterface::TABLE_NAME)
 */
class MonobankCurrency implements MonobankCurrencyInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(name="currency_code_from_iso", type="string", nullable=false)
     */
    private string|int $currencyCodeFromISO;

    /**
     * @ORM\Column(name="currency_code_to_iso", type="string", nullable=false)
     */
    private string|int $currencyCodeToISO;

    /**
     * @ORM\Column(name="currency_code_from", type="string", nullable=false)
     */
    private string $currencyCodeFrom;

    /**
     * @ORM\Column(name="currency_code_to", type="string", nullable=false)
     */
    private string $currencyCodeTo;

    /**
     * @ORM\Column(name="rate_sell", type="decimal", nullable=true)
     */
    private int|null|float $rateSell;

    /**
     * @ORM\Column(name="rate_buy", type="decimal", nullable=true)
     */
    private int|null|float $rateBuy;

    /**
     * @ORM\Column(name="rate_cross", type="decimal", nullable=true)
     */
    private int|null|float $rateCross;

    /**
     * @ORM\Column(name="currency_date", type="datetime")
     */
    protected ?DateTime $currencyDate;

    /**
     * @ORM\Column(name="created_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected DateTime $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime", options={"default": "CURRENT_TIMESTAMP"})
     */
    protected DateTime $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|int
     */
    public function getCurrencyCodeFromISO(): string|int
    {
        return $this->currencyCodeFromISO;
    }

    /**
     * @param string|int $currencyCodeFromISO
     *
     * @return MonobankCurrency
     */
    public function setCurrencyCodeFromISO(string|int $currencyCodeFromISO): self
    {
        $this->currencyCodeFromISO = $currencyCodeFromISO;

        return $this;
    }

    /**
     * @return string|int
     */
    public function getCurrencyCodeToISO(): string|int
    {
        return $this->currencyCodeToISO;
    }

    /**
     * @param string|int $currencyCodeToISO
     *
     * @return MonobankCurrency
     */
    public function setCurrencyCodeToISO(string|int $currencyCodeToISO): self
    {
        $this->currencyCodeToISO = $currencyCodeToISO;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCodeFrom(): string
    {
        return $this->currencyCodeFrom;
    }

    /**
     * @param string $currencyCodeFrom
     *
     * @return MonobankCurrency
     */
    public function setCurrencyCodeFrom(string $currencyCodeFrom): self
    {
        $this->currencyCodeFrom = $currencyCodeFrom;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrencyCodeTo(): string
    {
        return $this->currencyCodeTo;
    }

    /**
     * @param string $currencyCodeTo
     *
     * @return MonobankCurrency
     */
    public function setCurrencyCodeTo(string $currencyCodeTo): self
    {
        $this->currencyCodeTo = $currencyCodeTo;

        return $this;
    }

    /**
     * @return float|int|null
     */
    public function getRateSell(): ?float
    {
        return $this->rateSell;
    }

    /**
     * @param float|int|null $rateSell
     *
     * @return MonobankCurrency
     */
    public function setRateSell(float|int|null $rateSell): self
    {
        $this->rateSell = $rateSell;

        return $this;
    }

    /**
     * @return float|int|null
     */
    public function getRateBuy(): float|int|null
    {
        return $this->rateBuy;
    }

    /**
     * @param float|int|null $rateBuy
     *
     * @return MonobankCurrency
     */
    public function setRateBuy(float|int|null $rateBuy): self
    {
        $this->rateBuy = $rateBuy;

        return $this;
    }

    /**
     * @return float|int|null
     */
    public function getRateCross(): float|int|null
    {
        return $this->rateCross;
    }

    /**
     * @param float|int|null $rateCross
     *
     * @return MonobankCurrency
     */
    public function setRateCross(float|int|null $rateCross): self
    {
        $this->rateCross = $rateCross;

        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getCurrencyDate(): ?DateTime
    {
        return $this->currencyDate;
    }

    /**
     * @param DateTime|null $currencyDate
     */
    public function setCurrencyDate(?DateTime $currencyDate): self
    {
        $this->currencyDate = $currencyDate;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return MonobankCurrency
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     *
     * @return MonobankCurrency
     */
    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
