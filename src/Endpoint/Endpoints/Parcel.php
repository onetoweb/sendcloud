<?php

namespace Onetoweb\Sendcloud\Endpoint\Endpoints;

use Onetoweb\Sendcloud\Endpoint\AbstractEndpoint;

/**
 * Parcel Endpoint.
 */
class Parcel extends AbstractEndpoint
{
    /**
     * @param array $parcels
     * @param string $type = 'label'
     * @param string $format = 'pdf'
     * @param string $paperSize = 'A4'
     *
     * @return array|NULL
     */
    public function getDocument(int $parcelId, string $type = 'label', string $format = 'pdf', int $dpi= 72, string $paperSize = 'A4'): ?array
    {
        return $this->client->get("/parcels/$parcelId/documents/$type", [
            'paper_size' => $paperSize
        ], ['Accept' => $format == 'png' ? "image/$format"  : "application/$format"]);
    }
    
    /**
     * @param array $parcels
     * @param string $type = 'label'
     * @param string $format = 'pdf'
     * @param string $paperSize = 'A4'
     * 
     * @return array|NULL
     */
    public function getDocuments(array $parcels, string $type = 'label', string $format = 'pdf', string $paperSize = 'A4'): ?array
    {
        return $this->client->get("/parcel-documents/$type", [
            'parcels' => $parcels,
            'paper_size' => $paperSize
        ], ['Accept' => "application/$format"]);
    }
    
    /**
     * @return array|NULL
     */
    public function statuses(): ?array
    {
        return $this->client->get('/parcels/statuses');
    }
}
