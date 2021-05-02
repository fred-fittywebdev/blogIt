<?php

namespace App\Service;

use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;

class VerificationComment
{
    public function motInterdits(Commentaire $commentaire)
    {
        $interdits = [
            'merde',
            'con',
            'salaud',
            'pourri',
            'chier',
            'javascript'
        ];

        foreach ($interdits as $word) {
            if (strpos($commentaire->getContenu(), $word)) {
                return true;
            }
        }
        return false;
    }
}