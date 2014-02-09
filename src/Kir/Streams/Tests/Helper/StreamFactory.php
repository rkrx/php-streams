<?php
namespace Kir\Streams\Tests\Helper;

use Kir\Streams\Stream;

interface StreamFactory {
	/**
	 * @return Stream
	 */
	public function createStream();
} 