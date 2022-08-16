<?php
namespace CrmCareCloud\Webservice\RestApi\Client\SDK\Cache;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Psr16Cache;

class Cache extends Psr16Cache {
	private CacheItemPoolInterface $cache_item_pool;
	/** @var Rule[] $config  */
	private array $rules;

	public function __construct( CacheItemPoolInterface $cache_item_pool, array $rules = []) {
		$this->cache_item_pool = $cache_item_pool;
		$this->rules = $rules;

		parent::__construct($cache_item_pool);
	}

	/**
	 * @return CacheItemPoolInterface
	 */
	public function getCacheItemPool(): CacheItemPoolInterface {
		return $this->cache_item_pool;
	}

	/**
	 * @return array
	 */
	public function getRules(): array {
		return $this->rules;
	}

}