<?php

namespace App\Service;

use App\Entity\Commentaire;

class VerificationComment
{
    public function motInterdits(Commentaire $commentaire)
    {
        $interdits = [
            'merde',
            'con',
            'salaud',
            'pourri',
            'chier'
        ];

        foreach ($interdits as $word) {
            if (strpos($commentaire->getContenu(), $word)) {
                return true;
            }
        }
        return false;
    }
}