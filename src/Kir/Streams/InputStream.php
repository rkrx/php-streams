<?php
namespace Kir\Streams;

interface InputStream extends ClosableStream {
	/**
	 * @return bool
	 */
	public function isEof();
}
