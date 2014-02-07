<?php
namespace Kir\Streams;

use Kir\Streams\Exceptions\IOException;

interface ClosableStream extends Stream {
	/**
	 * @throws IOException
	 * @return $this
	 */
	public function close();
}