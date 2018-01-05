Yii2 I18N
=========
[![Build Status](https://travis-ci.org/yiithings/yii2-i18n.svg)](https://travis-ci.org/yiithings/yii2-i18n)
[![Latest Stable Version](https://poser.pugx.org/yiithings/yii2-i18n/v/stable.svg)](https://packagist.org/packages/yiithings/yii2-i18n) 
[![Total Downloads](https://poser.pugx.org/yiithings/yii2-i18n/downloads.svg)](https://packagist.org/packages/yiithings/yii2-i18n) 
[![Latest Unstable Version](https://poser.pugx.org/yiithings/yii2-i18n/v/unstable.svg)](https://packagist.org/packages/yiithings/yii2-i18n)
[![License](https://poser.pugx.org/yiithings/yii2-i18n/license.svg)](https://packagist.org/packages/yiithings/yii2-i18n)

Internationalization extension for Yii2 framework.

This extension use Gettext as message source and provide Web GUI(gii) editing message source.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yiithings/yii2-i18n "*"
```

or add

```
"yiithings/yii2-i18n": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

Add the component to your application.
```php
'components' => [
    'i18n' => [
        'class' => 'yiithings\i18n\I18N'
    ]
]
```

Use functions:
```php
echo __('Username');
__('Username'); // with echo
echo _x('Username', 'yii');
_xe('Username', 'yii'); // with echo
```

Edit messages:

Use [PoEdit](https://poedit.net/) create or edit your messages. 
`.po` and `.mo` files default save path is `@app/messages/`, e.g.
`@app/messages/en-US.mo`. If you want to change path rule, please
see [GettextMessageSource Class](src/GettextMessageSource.php).

