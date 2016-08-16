<?php 
namespace Nutch;

class CrawlState {
  const __default = self::IDLE;
  const IDLE = 'IDLE';
  const CREATED = 'CREATED';
  const RUNNING = 'RUNNING';
  const PAUSED = 'PAUSED';
  const STOPPED = 'STOPPED';
  const FINISHED = 'FINISHED';
  const COMPLETED = 'COMPLETED';
}

class JobType {
  const __default = self::NONE;
  const INJECT = 'INJECT';
  const GENERATE = 'GENERATE';
  const FETCH = 'FETCH';
  const PARSE = 'PARSE';
  const UPDATEDB = 'UPDATEDB';
  const INDEX = 'INDEX';
  const READDB = 'READDB';
  const PARSECHECKER = 'PARSECHECKER';
  const EXTRACT = 'EXTRACT';
  const CLAZZ = 'CLASS';
}

class JobState {
  const __default = self::ANY;
  const IDLE = 'IDLE';
  const RUNNING = 'RUNNING';
  const FINISHED = 'FINISHED';

  const PAUSED = 'PAUSED';
  const RESUMING = 'RESUMING';
  const STOPPING = 'STOPPING';

  const FAILED = 'FAILED';
  const KILLED = 'KILLED';
  const KILLING = 'KILLING';

  const CAN_NOT_CREATE = 'CAN_NOT_CREATE';

  const NOT_FOUND = 'NOT_FOUND';
  const COMPLETED = 'COMPLETED';
  const FAILED_COMPLETED = 'FAILED_COMPLETED';

  const ANY = 'ANY';
}

define('RESUME_KEY', 'fetcher.job.resume');

define('ARG_BATCH', "batch");

