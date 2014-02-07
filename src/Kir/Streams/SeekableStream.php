<?php
namespace Kir\Streams;

use Kir\Streams\Exceptions\IOException;

interface SeekableStream extends InputStream {
	/**
	 * @throws IOException
	 * @param int $pos
	 * @return $this
	 */
	public function setPosition($pos);

	/**
	 * @throws IOException
	 * @return int
	 */
	public function getPosition();

	/**
	 * @throws IOException
	 * @return $this
	 */
	public function rewind();

	/**
	 * @throws IOException
	 * @return int
	 */
	public function getSize();
} 