<?php
namespace Kir\Streams;

use Kir\Streams\Exceptions\IOException;

interface OpenableStream extends ClosableStream {
	/**
	 * @throws IOException
	 * @return $this
	 */
	public function open();
} 