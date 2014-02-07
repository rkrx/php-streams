<?php
namespace Kir\Streams;

use Kir\Streams\Exceptions\IOException;

interface InputStream extends Stream {
	/**
	 * @throws IOException
	 * @param int $length
	 * @return string
	 */
	public function read($length = null);

	/**
	 * @return bool
	 */
	public function isAtEnd();
}
