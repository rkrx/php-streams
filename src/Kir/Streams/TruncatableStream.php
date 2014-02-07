<?php
namespace Kir\Streams;

interface TruncatableStream extends ClosableStream {
	/**
	 * @param int $size
	 * @return $this
	 */
	public function truncate($size = 0);
} 