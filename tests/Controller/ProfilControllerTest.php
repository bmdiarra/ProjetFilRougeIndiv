<?php
// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfilControllerTest extends WebTestCase
{
    
    public function testShowProfil()
    {   
        $profil = static::createClient();
        
        $profil->request('GET', '/api/admin/profils');

        $this->assertEquals(200, $profil->getResponse()->getStatusCode());
    }

    public function testPostProfil()
    {   
        $profil = static::createClient();
        
        $profil->request('POST', '/api/admin/profils', 
        [
            'libelle' => 'Cm3',
            'isdeleted' => false,
            
        ]);

        $this->assertEquals(200, $profil->getResponse()->getStatusCode());
    }
}