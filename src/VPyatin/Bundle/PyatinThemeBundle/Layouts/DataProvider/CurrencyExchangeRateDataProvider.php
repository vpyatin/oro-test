<?php

namespace VPyatin\Bundle\PyatinThemeBundle\Layouts\DataProvider;

use VPyatin\Bundle\CoreBundle\Helper\CurrencyNumericToString;
use VPyatin\Bundle\CoreBundle\Service\Api\Monobank\Client;

class CurrencyExchangeRateDataProvider
{
    public function __construct(
        readonly private Client $client
    ) {
    }

    /**
     * @throws \Exception
     */
    public function getCurrencyRateData(): string
    {
        $values = $this->client->getAllCurrenciesValues();

        $data = CurrencyNumericToString::getCurrencyRate('uah', 'usd', $values);

        return sprintf('USD rate is <b>%s</b> <i>(on: %s)</i>', $data['rateSell'], (new \DateTime($data['date']))->format('Y-m-d H:i:s'));
    }
}
