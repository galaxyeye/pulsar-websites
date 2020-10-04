<?php

/**
 * built-in Server Shell
 *
 */
class ProxyShell extends Shell
{
    /**
     * Default ServerHost
     *
     * @var string
     */
    const DEFAULT_HOST = 'localhost';

    /**
     * Default ListenPort
     *
     * @var int
     */
    const DEFAULT_PORT = 8767;

    /**
     * server host
     *
     * @var string
     */
    protected $_host = null;

    /**
     * listen port
     *
     * @var string
     */
    protected $_port = null;

    /**
     * document root
     *
     * @var string
     */
    protected $_documentRoot = null;

    /**
     * Override initialize of the Shell
     *
     * @return void
     */
    public function initialize()
    {
        $this->_host = self::DEFAULT_HOST;
        $this->_port = self::DEFAULT_PORT;
        $this->_documentRoot = WWW_ROOT;
    }

    /**
     * Starts up the Shell and displays the welcome message.
     * Allows for checking and configuring prior to command or main execution
     *
     * Override this method if you want to remove the welcome information,
     * or otherwise modify the pre-command flow.
     *
     * @return void
     * @link http://book.cakephp.org/3.0/en/console-and-shells.html#hook-methods
     */
    public function startup()
    {
        parent::startup();
    }

    /**
     * Displays a header for the shell
     *
     * @return void
     */
    public function _welcome()
    {
        $this->out();
        $this->out(sprintf('<info>Welcome to CakePHP %s Console</info>', 'v' . Configure::version()));
        $this->hr();
        $this->out(sprintf('App : %s', APP_DIR));
        $this->out(sprintf('Path: %s', APP_SRC));
        $this->out(sprintf('DocumentRoot: %s', $this->_documentRoot));
        $this->hr();
    }

    /**
     * Override main() to handle action
     *
     * @return void
     */
    public function main()
    {
        $command = sprintf(
            "php -S %s:%d %s",
            $this->_host,
            $this->_port,
            escapeshellarg($this->_documentRoot . 'forward.php')
        );

        $port = ':' . $this->_port;
        $this->out(sprintf('built-in proxy server is running in http://%s%s/', $this->_host, $port));
        $this->out(sprintf('You can exit with <info>`CTRL-C`</info>'));
        system($command);
    }
}
