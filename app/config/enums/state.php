<?php
class CrawlState extends SplEnum {
	const __default = self::CREATED;
	const CREATED = 1;
	const RUNNING = 2;
	const STOPPED = 3;
	const COMPLETED = 4;
}

class NutchJobType extends SplEnum {
	const __default = self::NONE;
	const INJECT = 'INJECT';
	const GENERATE = 2;
	const FETCH = 3;
	const PARSE = 4;
	const UPDATEDB = 5;
}
