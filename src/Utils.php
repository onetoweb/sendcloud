<?php

namespace Onetoweb\Sendcloud;

/**
 * Sendcloud Api Utils.
 */
final class Utils
{
    /**
     * @param string $filename
     * @param array $data
     * 
     * @param bool
     */
    static function storeFile(string $filename, array $data): bool
    {
        return (file_put_contents($filename, base64_decode($data['data'])) !== false);
    }
}
