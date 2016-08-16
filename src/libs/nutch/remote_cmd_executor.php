<?php

namespace Nutch;

\App::import('Lib', array('nutch/nutch_client', 'nutch/remote_cmd_builder'));

class RemoteCmdExecutor extends \Object
{

	/**
	 * @var NutchClient
	 * */
    private $client;

    public function __construct()
    {
        $this->client = new NutchClient();
    }

    public function setDebugMsg($debugMsg)
    {
        $this->client->setDebugMsg($debugMsg);
    }

    /**
     * @param Crawl $crawl
     * @param string $priority
     * @return string jobId or error message
     **/
    function createNutchConfig($crawl, $priority = 'minor')
    {
        $cmdBuilder = new RemoteCmdBuilder($crawl);
        $nutchConfig = $cmdBuilder->buildNutchConfig($priority);
        $result = $this->client->createNutchConfig($nutchConfig);

        return $result['content'];
    }

    /**
     * @param $crawl
     * @return string seedDirectory or error message
     **/
    public function createSeed($crawl)
    {
        $cmdBuilder = new RemoteCmdBuilder($crawl);
        $nutchSeedList = $cmdBuilder->buildNutchSeedList();

        $result = $this->client->createSeed($nutchSeedList);

        return $result['content'];
    }

    /**
     * @param \Crawl $crawl
     * @param JobType $jobType
     * @return string jobId or error message
     **/
    function executeRemoteJob($crawl, $jobType)
    {
        $cmdBuilder = new RemoteCmdBuilder($crawl);

        if ($jobType == JobType::INJECT) {
            $command = $cmdBuilder->createInjectCommand();
        } else if ($jobType == JobType::GENERATE) {
            $command = $cmdBuilder->createGenerateCommand();
        } else if ($jobType == JobType::FETCH) {
            $command = $cmdBuilder->createFetchCommand();
        } else if ($jobType == JobType::PARSE) {
            $command = $cmdBuilder->createParseCommand();
        } else if ($jobType == JobType::UPDATEDB) {
            $command = $cmdBuilder->createUpdateDbCommand();
        } else if ($jobType == JobType::INDEX) {
            $command = $cmdBuilder->createIndexCommand();
        } else if ($jobType == JobType::PARSECHECKER) {
            $command = $cmdBuilder->createParseCheckerCommand();
        } else if ($jobType == JobType::EXTRACT) {
            $command = $cmdBuilder->createExtractCommand();
        } else {
            $this->log("Unkown job type $jobType");
            return false;
        }

        return $this->submitJob($command);
    }

    /**
     *
     * @deprecated Use \Nutch\NutchClient::query instead
     * */
    public function queryByCrawlFilter($crawl, $fields = null, $limit = null)
    {
        $cmdBuilder = new RemoteCmdBuilder($crawl);

        $dbFilter = $cmdBuilder->buildDbFilter(null, null, $fields, $limit);

        return $this->client->query($dbFilter);
    }

    /**
     * @param RemoteCommand $remoteCommand
     * @return string jobId or error message
     **/
    private function submitJob($remoteCommand)
    {
        $jobId = false;

        if ($remoteCommand !== false) {
            $result = $this->client->executeJob($remoteCommand->getJobConfig());
            $jobId = $result['content'];
        }

        return $jobId;
    }
}
