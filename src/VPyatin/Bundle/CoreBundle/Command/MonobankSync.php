<?php
declare(strict_types=1);

namespace VPyatin\Bundle\CoreBundle\Command;

use DateTime;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use VPyatin\Bundle\CoreBundle\Entity\MonobankCurrency;
use VPyatin\Bundle\CoreBundle\Entity\Repository\MonobankCurrencyRepository;
use VPyatin\Bundle\CoreBundle\Service\Api\Monobank\Client;
use Doctrine\ORM\EntityManager;

class MonobankSync extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'core:monobank:sync';

    /**
     * @var ObjectRepository|EntityRepository|MonobankCurrencyRepository
     */
    private ObjectRepository|EntityRepository|MonobankCurrencyRepository $monobankCurrencyRepository;

    /**
     * @param Client $monobankClient
     */
    public function __construct(
        private readonly Client $monobankClient,
        private readonly EntityManager $entityManager,
    ) {
        parent::__construct();
        $this->monobankCurrencyRepository = $this->entityManager->getRepository(MonobankCurrency::class);
    }

    protected function configure()
    {

    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $existEntities = [];
        foreach ($this->monobankCurrencyRepository->findAll() as $dbCurrency) {
            /** @var MonobankCurrency $dbCurrency */
            $key = sprintf('%s_%s', $dbCurrency->getCurrencyCodeFromISO(), $dbCurrency->getCurrencyCodeToISO());
            $existEntities[$key] = $dbCurrency;
        }
        $currencies = $this->monobankClient->getAllCurrenciesValues();
        foreach ($currencies as $_key => $currency) {
            $key = sprintf('%s_%s', $currency['currencyCodeA'], $currency['currencyCodeB']);
            $output->writeln(sprintf('#%s currencies: %s', $_key, $key));
            $entity = !empty($existEntities[$key]) ? $existEntities[$key] : new MonobankCurrency();
            if (empty($existEntities[$key])) {
                $entity->setCurrencyCodeFromISO($currency['currencyCodeA'])
                    ->setCurrencyCodeToISO($currency['currencyCodeB'])
                    ->setCurrencyCodeFrom((string) $currency['from_currency'])
                    ->setCurrencyCodeTo((string) $currency['to_currency'])
                    ->setCreatedAt((new DateTime()));
            }
            $entity->setRateSell($currency['rateSell'] ?? null)
                ->setRateBuy($currency['rateBuy'] ?? null)
                ->setRateCross($currency['rateCross'] ?? null)
                ->setCurrencyDate((new DateTime())->setTimestamp($currency['date']))
                ->setUpdatedAt((new DateTime()));
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();

        return 1;
    }
}
