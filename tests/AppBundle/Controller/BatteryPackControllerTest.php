<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Entity\Enum\BatteryTypeEnum;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BatteryPackControllerTest extends WebTestCase
{

    protected function setUp()
    {
        shell_exec('php bin/console doctrine:database:drop --force --env=test;');
        shell_exec('php bin/console doctrine:database:create --env=test;');
        shell_exec('php bin/console doctrine:schema:update --force --env=test;');
    }
    public function testNewAction()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/batterypack/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /batterypack/");
        $crawler = $client->click($crawler->selectLink('Create a new batteryPack')->link());

        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_batterypack[name]'  => null,
            'appbundle_batterypack[count]'  => 4,
            'appbundle_batterypack[type]'  =>  BatteryTypeEnum::AA,

        ));
        $client->submit($form);

        $crawler = $client->request('GET', '/batterypack/');
        $crawler = $client->click($crawler->selectLink('Create a new batteryPack')->link());
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_batterypack[name]'  => 'Test name',
            'appbundle_batterypack[count]'  => 3,
            'appbundle_batterypack[type]'  => BatteryTypeEnum::AAA,

        ));

        $client->submit($form);
        $crawler = $client->request('GET', '/batterypack/');
        $crawler = $client->click($crawler->selectLink('Create a new batteryPack')->link());
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_batterypack[name]'  => null,
            'appbundle_batterypack[count]'  => 1,
            'appbundle_batterypack[type]'  => BatteryTypeEnum::AA,

        ));
        $client->submit($form);
    }


}
