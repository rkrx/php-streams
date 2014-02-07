<?php
namespace Kir\Streams;

use Kir\Streams\Exceptions\IOException;

interface TruncatableStream extends Stream {
	/**
	 * @throws IOException
	 * @param int $size
	 * @return $this
	 */
	public function truncate($size = 0);
} 