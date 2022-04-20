<?php

namespace VPyatin\Bundle\CoreBundle\Cache;

use Doctrine\Common\Cache\Cache;

class CoreCache implements Cache
{
    public const CACHE_LIFETIME = 3600 * 24; // default 1 day lifetime

    public function __construct(
        private readonly Cache $cacheStorage
    ) {
    }

    /**
     * @param string $id
     * @param bool $asArray
     *
     * @return string|array|null
     */
    public function getCacheDataById(string $id, bool $asArray = false): array|string|null
    {
        if ($this->contains($id)) {
            $data = $this->fetch($id);

            return $asArray && $data ? json_decode($data, true) : $data;
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function fetch($id)
    {
        return $this->cacheStorage->fetch($id);
    }

    /**
     * @inheritDoc
     */
    public function contains($id): bool
    {
        return $this->cacheStorage->contains($id);
    }

    /**
     * @inheritDoc
     */
    public function save($id, $data, $lifeTime = self::CACHE_LIFETIME): bool
    {
        return $this->cacheStorage->save($id, $data, $lifeTime);
    }

    /**
     * @inheritDoc
     */
    public function delete($id): bool
    {
        return $this->cacheStorage->delete($id);
    }

    /**
     * @inheritDoc
     */
    public function getStats(): ?array
    {
        return $this->cacheStorage->getStats();
    }
}
