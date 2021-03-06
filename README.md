# kinncj\Twig\ReactExtension.php

## Installation

Package is available on [Packagist](https://packagist.org/packages/kinncj/reactextension), you can install it
using [Composer](http://getcomposer.org).

```bash
composer require kinncj/reactextension
```

## Usage

```php
$container
    ->register('kinncj.twig_extension', '\kinncj\Twig\ReactExtension')
    ->setPublic(false)
    ->addTag('twig.extension');
```

```yml
services:
    kinnj.twig_extension:
        class: kinncj\Twig\ReactExtension
        public: false
        tags:
            - { name: twig.extension }
```

```xml
<services>
    <service id="kinncj.twig_extension"
        class="kinncj\Twig\ReactExtension"
        public="false">
        <tag name="twig.extension" />
    </service>
</services>
```

```html
<div id="foo">
{{react_component('ComponentName')}}
</div>

<div id="bar">
{{react_component('Component2Name', user)}}
</div>

<div id="baz">
{{react_component('Component3Name', user, div)}}
{{react_component('Component4Name', user, div, my_id)}}
</div>

```
