<?php
namespace Kir\Streams;

use Kir\Streams\Exceptions\IOException;

interface InfiniteInputStream extends Stream {
	/**
	 * @throws IOException
	 * @param int $length
	 * @return string
	 */
	public function read($length = null);
}