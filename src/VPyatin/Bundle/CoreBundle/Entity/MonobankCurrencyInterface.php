<?php

namespace VPyatin\Bundle\CoreBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

interface MonobankCurrencyInterface
{
    public final const TABLE_NAME = 'monobank_currency_list';

    /**
     * @return string|int
     */
    public function getCurrencyCodeFromISO(): string|int;

    /**
     * @param string|int $currencyCodeFromISO
     *
     * @return MonobankCurrency
     */
    public function setCurrencyCodeFromISO(string|int $currencyCodeFromISO): self;

    /**
     * @return string|int
     */
    public function getCurrencyCodeToISO(): string|int;

    /**
     * @param string|int $currencyCodeToISO
     *
     * @return MonobankCurrency
     */
    public function setCurrencyCodeToISO(string|int $currencyCodeToISO): self;

    /**
     * @return string
     */
    public function getCurrencyCodeFrom(): string;

    /**
     * @param string $currencyCodeFrom
     *
     * @return MonobankCurrency
     */
    public function setCurrencyCodeFrom(string $currencyCodeFrom): self;

    /**
     * @return string
     */
    public function getCurrencyCodeTo(): string;

    /**
     * @param string $currencyCodeTo
     *
     * @return MonobankCurrency
     */
    public function setCurrencyCodeTo(string $currencyCodeTo): self;

    /**
     * @return float|int|null
     */
    public function getRateSell(): ?float;

    /**
     * @param float|int|null $rateSell
     *
     * @return MonobankCurrency
     */
    public function setRateSell(float|int|null $rateSell): self;

    /**
     * @return float|int|null
     */
    public function getRateBuy(): float|int|null;

    /**
     * @param float|int|null $rateBuy
     *
     * @return MonobankCurrency
     */
    public function setRateBuy(float|int|null $rateBuy): self;

    /**
     * @return float|int|null
     */
    public function getRateCross(): float|int|null;

    /**
     * @param float|int|null $rateCross
     *
     * @return MonobankCurrency
     */
    public function setRateCross(float|int|null $rateCross): self;

    /**
     * @return DateTime|null
     */
    public function getCurrencyDate(): ?DateTime;

    /**
     * @param DateTime|null $currencyDate
     */
    public function setCurrencyDate(?DateTime $currencyDate): self;

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime;

    /**
     * @param DateTime $createdAt
     *
     * @return MonobankCurrency
     */
    public function setCreatedAt(DateTime $createdAt): self;

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime;

    /**
     * @param DateTime $updatedAt
     *
     * @return MonobankCurrency
     */
    public function setUpdatedAt(DateTime $updatedAt): self;
}
