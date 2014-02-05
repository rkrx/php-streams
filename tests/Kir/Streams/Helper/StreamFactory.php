<?php
namespace Kir\Streams\Helper;

use Kir\Streams\Stream;

interface StreamFactory {
	/**
	 * @return Stream
	 */
	public function getStream();
} 