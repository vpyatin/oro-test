<?php

namespace VPyatin\Bundle\CoreBundle\Service\Api\Monobank;

use Doctrine\Common\Cache\Cache;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use VPyatin\Bundle\CoreBundle\Cache\CoreCache;
use VPyatin\Bundle\CoreBundle\Helper\CurrencyNumericToString;
use Oro\Bundle\ConfigBundle\Config\ConfigManager;

class Client implements ClientInterface
{
    /**#@+
     * Cache keys
     */
    const CACHE_KEY = 'monobank_request';
    const CACHE_KEY_CURRENCY_SUFFIX = 'currency';
    /**#@-*/

    /**#@+
     * Mono API
     */
    const SYSTEM_CONFIG_API_URL_PATH = 'core.currency_exchange_api_url';
    const API_GET_CURRENCY_ENDPOINT = 'bank/currency';
    /**#@-*/

    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $httpClient;

    /**
     * @var ?array
     */
    protected array|null $currencies = null;

    /**
     * @param LoggerInterface $logger
     * @param CoreCache $cache
     * @param ConfigManager $configManager
     */
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly Cache $cache,
        private readonly ConfigManager $configManager
    ) {
        $this->httpClient = HttpClient::create(
            [
                'headers' => ['Content-Type: application/json', 'Accept: application/json']
            ]
        );
    }

    public function getAllCurrenciesValues()
    {
        if ($this->currencies === null) {
            try {
                $cacheKey = $this->getCacheKey(self::CACHE_KEY_CURRENCY_SUFFIX);
                $json = $this->cache->getCacheDataById($cacheKey);
                if (!$json) {
                    $json = $this->httpClient->request(
                        self::HTTP_GET,
                        $this->getEndpoint(self::API_GET_CURRENCY_ENDPOINT)
                    )->getContent();
                    $this->cache->save($cacheKey, $json);
                }
                $this->currencies = json_decode($json, true);
                $this->applyCurrencyMap();
            } catch (ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface|TransportExceptionInterface $e) {
                $this->logger->error($e->__toString());
            }
        }
        
        return $this->currencies;
    }

    /**
     * @return void
     */
    protected function applyCurrencyMap(): void
    {
        $this->currencies = array_map(
            function ($item) {
                $item['from_currency'] = CurrencyNumericToString::getCodeByISOValue($item['currencyCodeA']);
                $item['to_currency'] = CurrencyNumericToString::getCodeByISOValue($item['currencyCodeB']);

                return $item;
            },
            $this->currencies
        );
    }

    /**
     * @param string $suffix
     *
     * @return string
     */
    protected function getCacheKey(string $suffix): string
    {
        return sprintf('%s.%s', self::CACHE_KEY, $suffix);
    }

    /**
     * @param string $endpoint
     *
     * @return string
     */
    protected function getEndpoint(string $endpoint): string
    {
        return sprintf('%s/%s', $this->configManager->get(self::SYSTEM_CONFIG_API_URL_PATH), ltrim($endpoint, '/'));
    }
}
