<?php

namespace Puphpet\MainBundle\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

abstract class ExtensionAbstract
{
    protected $container;

    protected $name;
    protected $slug;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getName()
    {
        if (!$this->name) {
            throw new \Exception('Extension name has not been defined');
        }

        return $this->name;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getSlug()
    {
        if (!$this->slug) {
            throw new \Exception('Extension slug has not been defined');
        }

        return $this->slug;
    }

    /**
     * @return ControllerInterface
     */
    abstract public function getController();

    /**
     * @param array $data
     * @return string
     */
    public function render(array $data = [])
    {
        return $this->getController()
            ->indexAction($data)
            ->getContent();
    }

    /**
     * Whether any data came from outside sources
     *
     * @return bool
     */
    public function hasCustomData()
    {
        return empty($this->customData) ? false : true;
    }
}