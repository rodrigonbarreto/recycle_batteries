<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Statistic Batteries', $crawler->filter('#container h3')->text());

        $crawler = $client->request('GET', '/');
        $firstResult = $crawler->filter(".tbBatteries tr ")->eq(1);
        $secondResult = $crawler->filter(".tbBatteries tr ")->eq(2);

        $this->assertContains('5', $firstResult->text());
        $this->assertContains('AA', $firstResult->text());

        $this->assertContains('AAA', $secondResult->text());
        $this->assertContains('3', $secondResult->text());
    }


}
