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

    public function createComponent($componentName, $arguments = null, $tag = "div", $selector = null )
    {
        {{ react_component('ComponentName', params, 'div', '#id') }}
        $this->reactJS->setComponent($componentName, $arguments);

        if (is_null($selector)) {
            $selector = sprintf('component_%d', mt_rand());
        }

        $component = sprintf(
            '<%s id="%s">%s</%s>',
            $tag,
            $selector,
            $this->reactJS->getMarkup(),
            $tag
        );

        $javascript = sprintf(
            '<script>%s</script>',
            $this->reactJS->getJS(sprintf('#%s', $selector))
        );

        return sprintf("%s\n%s");
    }

    public function getName()
    {
        return 'kinncj_react';
    }
}
