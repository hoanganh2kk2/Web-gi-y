<?php

namespace App\Security;


use App\Hps\eBug;

class SecurityService implements SecurityInterface
{
    const key = [1307 , 7717];
    const private_key =  '-----BEGIN PRIVATE KEY-----
MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDK5O4nMK4wil2c
HDCovCrAUj2GxCpBZDq27jxmZGZsaGXvx0YQQiEu2PiVjnIRAVpVTQ1XRGAKSrVa
9At/yUy8suZx0IIsiRzbMNdgjJsT371fcHpUTF0qsvn9HA+bKMASuUFNEF2Z7iPN
dL7jBysA4vBXWWamMrhFwU8d6fGDs7LHP/Nw3wMKCm0i0qoAhqDrAZOLgxzNuhkp
IQrRBFfd9PQdwI1CV2Vz1+2Lp+0OHbRToVtlG6k1Kir6rcxETBqd7R4ZWzZI42Wh
bN9scj76gS1pt2tTqvOrkUjWu/WF3RU0MIURywonz+DHYbma/mATl+qzK5wwbC/+
+yZBmwZFAgMBAAECggEAL2lot3K6ObCTqF+0BTIXYWK2avAbGbXEvKuWJK0wfAO3
Ul1EI5d4bpyYFka3o/6nb8h2Jh7dvHnxwCPILh/JlUzO6ei6CpMt0ZCru62PrYi6
lXtQsrM3kDtLjJiKkwzmOVneBxaccNSDvEacNqwdofLmC9thz9OJWQ+Pn+Njow0n
wG+jYOpmZqqBMG4cn48v9uH0IXYgN/jKqX0pmEHeBLzykzCE0Z6msq+3kP9hlM9C
2NGKGrVEHHrQYkgPmeLqvn3Z1XIVJqTSdYcig+iAOW/FxuklOtETmrpZPxPP59bw
SGFwgOaROO16WueUKZ2k5RvrxGIsMkEn4cL9k8nDTwKBgQDwH0sIgxIdg5weJTlX
HNSO5AZzId6PHU+w+TkIZAd3ezfuDbCcCQN/FXtGu+FZMGhtj+gfwa/yvNwpN0k7
3Q7mgK6ogySgdqy34VrFiHpG9vcSaBThvsRw2RiCuV/zUvE6/uZPeRi3i78XIu+d
bYmS5x5cC1SjpL7yAsuenblvZwKBgQDYT3RoIdmUMQEhFKmHe+qUPsOlNz9gMcPr
fxXecguKVDqy9txuZHS7x0pzqjT6czhlQwtV9lOraHemML4ffIBzWmPjyIN8hpkv
eo4NCPg5xr4l07mnT9/K3SMyIKbJ6blGiDTwoM+kDQwCrhEnszsSapH3BsFWu/J6
cMh+dVRNcwKBgFHEhjuOzqNoRshpKp6Efclu0tdv6CbZ92IvbAF0dqp0NjaFSOfJ
lfw3p3QN1I4XkugEQipWPYEuWNZcMj8FZuaNWWyew+E0qFoxjkSH1gPGY5pMARhi
auh2tQcG8yqbyvOpC2pytT0DhH3vcqMsQtXYiBkV7quPFUq6MvZ/hT7vAoGAGm8z
UZp5ZYPLmIhW42jAVReKf0FOLGpIgBoKySF0yZXbio1iiNcb8Oq87X+qc8Tq6m0U
EJBGz1a38IZaZayoYfB07pxNfUVRqRy4CV3EQANKr4K9WHYJalg1+eVFnL1EWBtD
JPjyByFVC2rMS+a6XFjLt72KmRfk3RO1XMbn44MCgYApTy3wOe+RhyylXe9Ld0vg
EKcurEWJet2/8nS0KS0bLLr/YtyevxD70HX3NxHa57+5vG0HeRcIbcRw6iagN1Xz
s6uqnSY5wWQdsUEH9jhwoGKwBJXllwsW6MktNkGm7wM9T990bZVxNm5AZKZXDTZN
Uskxh0XFdgvAsdzt8Zm/Sw==
-----END PRIVATE KEY-----';

    const public_key = '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAyuTuJzCuMIpdnBwwqLwq
wFI9hsQqQWQ6tu48ZmRmbGhl78dGEEIhLtj4lY5yEQFaVU0NV0RgCkq1WvQLf8lM
vLLmcdCCLIkc2zDXYIybE9+9X3B6VExdKrL5/RwPmyjAErlBTRBdme4jzXS+4wcr
AOLwV1lmpjK4RcFPHenxg7Oyxz/zcN8DCgptItKqAIag6wGTi4MczboZKSEK0QRX
3fT0HcCNQldlc9fti6ftDh20U6FbZRupNSoq+q3MREwane0eGVs2SONloWzfbHI+
+oEtabdrU6rzq5FI1rv1hd0VNDCFEcsKJ8/gx2G5mv5gE5fqsyucMGwv/vsmQZsG
RQIDAQAB
-----END PUBLIC KEY-----';

    public function get_private_key(): string
    {
        return self::private_key;
    }

    public function get_public_key(): string
    {
        return self::public_key;
    }


    public function get_public_key_n(): array
    {
        return [
            'e' => 5,
            'n' => 10086119
        ];
    }

    public function get_private_key_n(): array
    {
        return [
            'd' => 8061677,
            'n' => 10086119
        ];
    }


    public function encoding($parameter): string
    {
        try {
            $private_key = self::get_private_key();
            // Tạo một đối tượng RSA Private Key từ chuỗi Private Key
            $rsa_private_key = openssl_pkey_get_private($private_key);
            // Mã hóa dữ liệu bằng RSA Private Key
            openssl_private_encrypt(json_encode($parameter), $encrypted_data, $rsa_private_key);
            // Chuyển đổi dữ liệu đã mã hóa thành dạng Base64 để dễ dàng truyền tải
            return base64_encode($encrypted_data);
        }catch (\Exception $e) {
            eBug::pushNotification($e);
            return false;
        }
    }

    public function decrypt($parameter) {
        try {
            if (!is_string($parameter) || empty($parameter)) {
                throw new \InvalidArgumentException('Invalid input parameter');
            }

            // Lấy ra public key
            $publicKey = self::get_public_key();
            // Tạo một đối tượng RSA Public Key từ chuỗi Public Key
            $publicKeyResource = openssl_pkey_get_public($publicKey);
            if (!$publicKeyResource) {
                throw new \RuntimeException('Failed to get public key resource');
            }
            // Giải mã dữ liệu bằng RSA Public Key
            $result = openssl_public_decrypt(base64_decode($parameter), $decrypted, $publicKeyResource, OPENSSL_PKCS1_PADDING);
            if (!$result) {
                throw new \RuntimeException('Failed to decrypt data');
            }
            return json_decode($decrypted);
        } catch (\Exception $e) {
            eBug::pushNotification($e);
            return false;
        }
    }



    function rsa_decrypt($parameter): string
    {
        try {
            $privateKey = $this->get_private_key_n();
            if (!$privateKey) {
                return false;
            }
            $d = $privateKey['d'];
            $n = $privateKey['n'];
            $decryptedMessage = '';
            $encryptedCharCodes = explode(' ', $parameter);
            foreach ($encryptedCharCodes as $charCode) {
                $encryptedCharCode = intval($charCode);
                $decryptedCharCode = modpow($encryptedCharCode, $d, $n);
                if ($decryptedCharCode == false) {
                    return false;
                }
                $decryptedMessage .= chr($decryptedCharCode);
            }
            return $decryptedMessage;
        } catch (\Exception $e) {
            eBug::pushNotification($e);
            return false;
        }
    }






}
