<?php
namespace Kir\Streams;

interface SeekableStream extends InputStream {
	/**
	 * @param int $pos
	 * @return $this
	 */
	public function setPosition($pos);

	/**
	 * @return int
	 */
	public function getPosition();

	/**
	 * @return $this
	 */
	public function rewind();

	/**
	 * @return int
	 */
	public function getSize();
} 