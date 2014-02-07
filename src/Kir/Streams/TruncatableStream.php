<?php
namespace Kir\Streams;

use Kir\Streams\Exceptions\IOException;

interface TruncatableStream extends Stream {
	/**
	 * @throws IOException
	 * @return $this
	 */
	public function truncate();
} 