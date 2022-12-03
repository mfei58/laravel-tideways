<?php
namespace laravelTideways;
use laravelTideways\constract\ManagerInterface;
use laravelTideways\exception\ExtensionNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Config\Repository as Config;

class Manager implements ManagerInterface
{
    /**
     * @var Application
     */
    protected $app;
    /**
     * @var bool
     */
    protected $enable;
    /**
     * @var Handler
     */
    protected $handler;
    /**
     * @param Application $app
     * @param Config $config
     */
    public function __construct(Application $app, Config $config)
    {
        $this->app    = $app;
        $this->enable = $config->get('tideways.enable');
        $this->handler = $this->app->make('tidewaysHandler');
    }
    public function enable()
    {
        if(!$this->isEnable()){
            return false;
        }
        $this->checkExtension();
        if (!isset($_SERVER['REQUEST_TIME_FLOAT'])) {
            $_SERVER['REQUEST_TIME_FLOAT'] = microtime(true);
        }
        tideways_enable(TIDEWAYS_FLAGS_CPU | TIDEWAYS_FLAGS_MEMORY);
        tideways_span_create('sql');
        return true;
    }

    public function disable()
    {
        if(!$this->isEnable()){
            return false;
        }
        $this->checkExtension();
        $this->handler->exec();
    }

    /**
     * 是否已开启监控
     * @access public
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->enable;
    }

    /**
     * 检查扩展是否安装
     */
    protected function checkExtension()
    {
        $this->checkXhprof();
        $this->checkTideways();
        $this->checkMongodb();
    }
    protected function checkXhprof()
    {
        if(!extension_loaded("xhprof")){
            throw new ExtensionNotFoundException("extension xhprof must be loaded","xhprof");
        }
    }

    protected function checkTideways()
    {
        if(!extension_loaded("tideways")){
            throw new ExtensionNotFoundException("extension tideways must be loaded","xhprof");
        }
    }

    protected function checkMongodb()
    {
        if(!extension_loaded("mongodb")){
            throw new ExtensionNotFoundException("extension mongodb must be loaded","mongodb");
        }
    }
}