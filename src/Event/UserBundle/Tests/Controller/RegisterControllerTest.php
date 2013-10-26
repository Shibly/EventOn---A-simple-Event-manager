<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/26/13
 * Time: 1:55 PM
 */

namespace Event\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();
    }

} 