<?php
namespace Kir\Streams\Helper;

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
	public function getStream() {
		return call_user_func($this->callback);
	}
}