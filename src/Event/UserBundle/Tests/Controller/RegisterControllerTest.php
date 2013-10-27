<?php
/**
 * Created by PhpStorm.
 * User: shibly
 * Date: 10/26/13
 * Time: 1:55 PM
 */

namespace Event\UserBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class RegisterControllerTest extends WebTestCase
{
    public function testRegister()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($crawler->filter('html:contains("Register")')->count() > 0);
        $userNameVal = $crawler->filter("#user_register_username")->attr('value');
        var_dump($userNameVal);
    }
}