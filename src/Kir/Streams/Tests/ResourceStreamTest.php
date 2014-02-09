<?php
namespace Kir\Streams\Tests;

use Kir\Streams\Tests\Helper;
use Kir\Streams\RandomAccessStream;
use Kir\Streams\TruncatableStream;

class ResourceStreamTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var Helper\StreamFactory
	 */
	private $subjectFactory = null;

	/**
	 */
	protected function setUp(Helper\StreamFactory $factory) {
		parent::setUp();
		$this->subjectFactory = $factory;
	}

	/**
	 */
	public function testRead() {
		$stream = $this->createSubject();
		$data = $stream->read(26);
		\PHPUnit_Framework_Assert::assertEquals('Lorem ipsum dolor sit amet', $data);
	}

	/**
	 */
	public function testReadAll() {
		$stream = $this->createSubject();
		$data = $stream->read();
		$hash = md5($data);
		\PHPUnit_Framework_Assert::assertEquals('cbdd94ceda68ce93d86bc5c84c2537d6', $hash);
	}

	/**
	 */
	public function testWrite() {
		$stream = $this->createSubject();
		$stream->rewind();
		$stream->write('ABCDEFG');
		$stream->rewind();
		$data = $stream->read(7);
		\PHPUnit_Framework_Assert::assertEquals('ABCDEFG', $data);
	}

	/**
	 */
	public function testPositioning() {
		$stream = $this->createSubject();
		$stream->write('0987654321');
		$stream->setPosition(0);
		\PHPUnit_Framework_Assert::assertEquals(0, $stream->getPosition(), 'Set position to stream start');
		$stream->setPosition(5);
		\PHPUnit_Framework_Assert::assertEquals(5, $stream->getPosition(), 'Set position to 5');
		\PHPUnit_Framework_Assert::assertEquals('54321', $stream->read(5));
	}

	/**
	 */
	public function testTruncate() {
		$stream = $this->createSubject();

		$this->truncateStream($stream);
		$stream->write('This is a test');
		$this->truncateStream($stream);
		\PHPUnit_Framework_Assert::assertEquals(0, $stream->getPosition());
	}

	/**
	 * @param TruncatableStream $stream
	 */
	private function truncateStream(TruncatableStream $stream) {
		$stream->truncate();
	}

	/**
	 * @return RandomAccessStream
	 */
	private function createSubject() {
		return $this->subjectFactory->createStream();
	}
}
 