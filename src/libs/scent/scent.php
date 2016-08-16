<?php 

namespace Scent;

class JobType {
    const __default = self::CLASS;
    const SEGMENT = 'SEGMENT';
    const AUTOEXTRACT = 'AUTOEXTRACT';
    const RULEDEXTRACT = 'RULEDEXTRACT';
    const BUILD = 'BUILD';
    const CLAZZ = 'CLASS';
}

class JobState {
    const __default = self::IDLE;
    const IDLE = 'IDLE';
    const RUNNING = 'RUNNING';
    const FINISHED = 'FINISHED';
    const FAILED = 'FAILED';
    const KILLED = 'KILLED';
    const STOPPING = 'STOPPING';
    const KILLING = 'KILLING';
    const ANY = 'ANY';
}
