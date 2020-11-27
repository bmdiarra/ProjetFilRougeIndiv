<?php
// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class ProfilControllerTest extends WebTestCase
{
    // on se connecte
    protected function createAuthenticatedClient(string $username, string $password): KernelBrowser
    {
        $client = static::createClient();
        $connexion = [
            "username" => $username,
            "password" => $password
        ];
        $client->request(
            'POST',
            '/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($connexion)
        );
        $data = \json_decode($client->getResponse()->getContent(), true);
        
        $client->setServerParameter('HTTP_Authorization', \sprintf('Bearer %s', $data['token']));
        
        $client->setServerParameter('CONTENT_TYPE', 'application/json');
        //dd($client);
        return $client;
    }
// on teste la liste de profils

    public function testListProfils()
    {
        $client = $this->createAuthenticatedClient("ADMIN1", "pass1234");
        
        $client->request('GET', '/api/admin/profils');
       // dd($client->getResponse()->getStatusCode());
        $this->assertResponseStatusCodeSame(200);
      }

      public function testCreateProfil()
    {
        $client = $this->createAuthenticatedClient("ADMIN1", "pass1234");
        $client->request(
            'POST',
            '/api/admin/profils',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{
              "libelle":"Aly",
              "archivage":0
            }'
        );
        $responseContent = $client->getResponse();
        $this->assertResponseStatusCodeSame(200);

    }
}