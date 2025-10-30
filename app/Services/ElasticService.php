<?php

namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder;

class ElasticService
{
    protected $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()
            ->setHosts([env('ELASTICSEARCH_HOST')])
            ->build();
    }

    public function indexCompany($company)
    {
        $params = [
            'index' => 'companies',
            'id'    => $company->id,
            'body'  => [
                'name'        => $company->name,
                'industry'    => $company->industry,
                'description' => $company->description,
            ],
        ];

        return $this->client->index($params);
    }

    public function searchCompany($query)
    {
        $params = [
            'index' => 'companies',
            'body'  => [
                'query' => [
                    'multi_match' => [
                        'query'  => $query,
                        'fields' => ['name^2','industry','description'],
                    ],
                ],
            ],
        ];

        return $this->client->search($params);
    }
}
