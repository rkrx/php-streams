<?php
namespace Kir\Streams;

interface ClosableInfiniteInputStream extends InfiniteInputStream, ClosableStream {
	/**
	 * @param int $length
	 * @return string
	 */
	public function read($length = null);
}