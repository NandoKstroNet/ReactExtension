<?php

namespace kinncj\Twig;

class ReactExtension extends \Twig_Extension
{
    protected $reactJS;

    /**
     * @param string $reactjs    The react.js file
     * @param string $components The app.js file
     */
    public function __construct($reactjs, $components)
    {
        $this->reactJS = new \ReactJS(
            file_get_contents($reactjs),
            file_get_contents($components)
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('react_component', array($this, 'createComponent')),
        );
    }

    public function createComponent($componentName, $arguments = null)
    {
        $this->reactJS->setComponent($componentName, $arguments['data']);

        $component = sprintf(
            '<%s id="%s">%s</%s>',
            $arguments['tag'],
            $arguments['id'],
            $this->reactJS->getMarkup(),
            $arguments['tag']
        );

        $javascript = sprintf(
            '<script>%s</script>',
            $this->reactJS->getJS(sprintf('#%s', $arguments['id']))
        );

        return sprintf("%s\n%s");
    }

    protected function mergeArguments(array $arguments = array())
    {
        $defaultArguments = array(
            "tag"  => "div",
            "id"   => sprintf('component_%d', mt_rand()),
            "data" => null,
        );

        return array_merge($arguments, $defaultArguments);
    }

    public function getName()
    {
        return 'kinncj_react';
    }
}
