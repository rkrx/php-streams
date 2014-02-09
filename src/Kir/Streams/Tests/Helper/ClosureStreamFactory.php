<?php
namespace Kir\Streams\Tests\Helper;

use Closure;
use Kir\Streams\Stream;

class ClosureStreamFactory implements StreamFactory {
	/**
	 * @var Closure
	 */
	private $callback = null;

	/**
	 */
	public function __construct(Closure $callback) {
		$this->callback = $callback;
	}

	/**
	 * @return Stream
	 */
	public function createStream() {
		return call_user_func($this->callback);
	}
}