<?php

namespace App\Tests;

use App\Entity\Commentaire;
use App\Service\VerificationComment;
use PHPUnit\Framework\TestCase;

class VerificationCommentTest extends TestCase
{

    protected $commentaire;

    protected function setUp(): void
    {

        $this->commentaire = new Commentaire();
    }

    public function testMotsInterit()
    {
        $service = new VerificationComment();
        $this->commentaire->setContenu("Ceci est un commentaire de merde");

        $resultat = $service->motInterdits($this->commentaire);

        $this->assertTrue($resultat);
    }

    public function motsAutorisés()
    {
        $service = new VerificationComment();

        $this->commentaire->setContenu("Ceci est un commentaire sans mots interdits de merde");

        $resultat = $service->motInterdits($this->commentaire);

        $this->assertFalse($resultat);
    }
}