<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/29/13
 * Time: 5:15 PM
 */

namespace Event\EventBundle\Twig;

use Event\EventBundle\Util\DateUtil;

class EventExtension extends \Twig_Extension
{

    public function getName()
    {
        return 'event';
    }


    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('ago', array($this, 'ago')),
            new \Twig_SimpleFilter('hello', array($this, 'hello'))
        );
    }


    public function ago(\DateTime $dt)
    {
        return DateUtil::ago($dt);
    }

    public function hello()
    {
        return DateUtil::sayHello();
    }
}