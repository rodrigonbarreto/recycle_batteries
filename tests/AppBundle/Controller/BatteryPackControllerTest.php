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

    /**
     * @test
     *
     * @dataProvider testNewActionDataProvider
     *
     * @param array $fieldsBattery
     */
    public function testNewAction(array $fieldsBattery)
    {
        $client = static::createClient();
        $this->submitBattery($client, $fieldsBattery['batt1']);
        $this->submitBattery($client, $fieldsBattery['batt2']);
        $this->submitBattery($client, $fieldsBattery['batt3']);

        $crawler = $client->request('GET', '/');
        $firstResult = $crawler->filter(".tbBatteries tr ")->eq(1);
        $secondResult = $crawler->filter(".tbBatteries tr ")->eq(2);

        $this->assertContains('5', $firstResult->text());
        $this->assertContains('AA', $firstResult->text());
        $this->assertContains('AAA', $secondResult->text());
        $this->assertContains('3', $secondResult->text());

    }

    public function submitBattery($client, $fieldsBattery)
    {
        $crawler = $client->request('GET', '/batterypack/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /batterypack/");
        $crawler = $client->click($crawler->selectLink('Create a new batteryPack')->link());

        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_batterypack[name]'  => $fieldsBattery['name'],
            'appbundle_batterypack[count]'  => $fieldsBattery['count'],
            'appbundle_batterypack[type]'  =>  $fieldsBattery['type'],

        ));
        $client->submit($form);
    }

    /**
     * @return array
     */
    public function testNewActionDataProvider()
    {
        return [
            'Battery Test OK' => [
                'batteries' => [
                    'batt1' => ['name' => 'AAA', 'count' => 4, 'type' => BatteryTypeEnum::AA],
                    'batt2' => ['name' => 'Test name', 'count' => 3, 'type' => BatteryTypeEnum::AAA],
                    'batt3' => ['name' => 'BBE', 'count' => 1, 'type' => BatteryTypeEnum::AA],
                ]
            ],
        ];
    }
}
