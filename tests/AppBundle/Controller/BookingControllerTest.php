<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookingControllerTest extends WebTestCase
{
    /**
     * @dataProvider urlProvider
     */
    public function testHomePageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider()
    {
        return [
	        ['/']
    	];
    }

    public function testCheckoutPageIsNotRenderWithoutPostMethod()
    {
        $client = self::createClient();
        $client->request('GET', '/payment');
        $this->assertFalse($client->getResponse()->isSuccessful());
    }
}
