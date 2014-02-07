<?php
namespace Kir\Streams;

interface VersatileStream extends RandomAccessStream, TruncatableStream, ClosableStream, OpenableStream {
}