<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PageShowsTest extends WebTestCase
{
    public function testMainPage(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Formulaire de contact');
    }

    public function testMainPage2(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Formulaire de contact');
    }

    public function testMainPage3(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Formulaire de contact');
    }

//     public function testListPage(): void
//     {
//         $client = static::createClient();
//         $crawler = $client->request('GET', '/liste');

//         $this->assertResponseIsSuccessful();
//         $this->assertSelectorTextContains('h1', 'Liste de contacts');
//     }
}
