<?php

namespace App\Security;

interface SecurityInterface
{
    public function get_private_key();
    public function get_public_key();
    public function encoding($parameter): string;
    public function decrypt($parameter);
    public function rsa_decrypt($parameter);
}
