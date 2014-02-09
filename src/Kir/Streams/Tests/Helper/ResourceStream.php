<?php
namespace Kir\Streams\Tests\Helper;

use Kir\Streams\Exceptions\InvalidStreamOperationException;
use Kir\Streams\Exceptions\IOException;
use Kir\Streams\RandomAccessStream;
use Kir\Streams\TruncatableStream;

class ResourceStream implements RandomAccessStream, TruncatableStream {
	/**
	 * @var resource
	 */
	private $res = null;

	/**
	 * @var int
	 */
	private $size = null;

	/**
	 * @var array
	 */
	private $meta = array();

	/**
	 * @param string $filename
	 * @param string $mode
	 */
	public function __construct($filename, $mode) {
		$res = fopen($filename, $mode);
		$this->setResource($res);
	}

	/**
	 */
	public function __destruct() {
		try {
			$this->disconnect();
		} catch (\Exception $e) {
		}
	}

	/**
	 * @throws IOException
	 * @return $this
	 */
	public function disconnect() {
		try {
			if($this->res === null) {
				return;
			}
			if(!@fclose($this->res)) {
				throw new IOException("Could not close stream");
			}
		} catch (IOException $e) {
			throw $e;
		} catch (\Exception $e) {
			new IOException($e->getMessage(), $e->getCode(), $e);
		}
	}

	/**
	 * @return bool
	 */
	public function isAtEnd() {
		return feof($this->res);
	}

	/**
	 * @param int $length
	 * @return string
	 */
	public function read($length = null) {
		if($length === null) {
			$length  = -1;
		}
		$data = stream_get_contents($this->res, $length);
		return $data;
	}

	/**
	 * @param string $data
	 * @return $this
	 */
	public function write($data) {
		fwrite($this->res, $data);
		$this->size = max(ftell($this->res), $this->size);
		return $this;
	}

	/**
	 * @return int
	 */
	public function getPosition() {
		if($this->isSeekable()) {
			return ftell($this->res);
		}
		return null;
	}

	/**
	 * @param int $pos
	 * @throws InvalidStreamOperationException
	 * @return $this
	 */
	public function setPosition($pos) {
		if (!$this->isSeekable()) {
			throw new InvalidStreamOperationException("Stream is not seekable");
		}

		$pos = min($pos, $this->getSize() - 1);
		$pos = max($pos, 0);

		fseek($this->res, $pos, SEEK_SET);

		if(ftell($this->res) == $pos) {
			return $this;
		}

		rewind($this->res);
		fread($this->res, $pos);

		if(ftell($this->res) != $pos) {
			throw new InvalidStreamOperationException("Unable to set position");
		}

		return $this;
	}

	/**
	 * @return $this
	 */
	public function rewind() {
		rewind($this->res);
		return $this;
	}

	/**
	 * @return int
	 */
	public function getSize() {
		$this->updateSize();
		return $this->size;
	}

	/**
	 * @return $this
	 */
	public function truncate() {
		ftruncate($this->res, 0);
		$this->rewind();
		return $this;
	}

	/**
	 * @return bool
	 */
	protected function isSeekable() {
		return !!$this->getMetaValue('seekable', false);
	}

	/**
	 * @param resource $resource
	 */
	protected function setResource($resource) {
		$this->res = $resource;
		$this->meta = stream_get_meta_data($this->res);
		$this->meta = is_array($this->meta) ? $this->meta : array();

		if ($this->isSeekable()) {
			$pos = ftell($this->res);
			fseek($this->res, 0, SEEK_END);
			$this->size = ftell($this->res);
			fseek($this->res, $pos, SEEK_SET);
		}
	}

	/**
	 */
	private function updateSize() {
		$this->size = max(ftell($this->res), $this->size);
	}

	/**
	 * @param string $string
	 * @param mixed $default
	 * @return mixed
	 */
	private function getMetaValue($string, $default) {
		if(array_key_exists($string, $this->meta)) {
			return $this->meta[$string];
		}
		return $default;
	}
}
