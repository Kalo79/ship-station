<?php

namespace MichaelB\ShipStation\Endpoints;


use MichaelB\ShipStation\Models\Store;

class Stores extends BaseEndpoint
{
    protected $endpoint = '/stores/';

    /**
     * Get a single store by id
     *
     * @param string $storeId
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getStore($storeId = '')
    {
        return $this->get($storeId);
    }

    /**
     * Update a store
     * !WARNING: Full resource must be specified
     * @param Store $store
     * @return \GuzzleHttp\Psr7\Response
     */
    public function update(Store $store)
    {
        return $this->put($store->storeId, ['form_params' => $store->toArray()]);
    }

    /**
     * @param bool|false $showInactive
     * @param string     $marketplaceId
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function listStores($showInactive = false, $marketplaceId = '')
    {
        $params = array();
        if($showInactive != false){
            $params['showInactive'] = $showInactive;
        }
        if($marketplaceId != ''){
            $params['marketplaceId'] = $marketplaceId;
        }
        return $this->get('', ['query' => $params]);
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function listMarketplaces()
    {
        return $this->get('marketplaces');
    }

    /**
     * Initiates a store refresh
     *
     * @param string $storeId
     * @param string $refreshDate
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function refreshStore($storeId = '', $refreshDate = null)
    {
        $params = array();
        if($storeId != ''){
            $params['storeId'] = $storeId;
        }
        if($refreshDate != null){
            $params['refreshDate'] = $refreshDate;
        }
        return $this->post('refreshstore', ['query' => $params]);
    }

    /**
     * Retrieves the refresh status of a given store
     * @param string $storeId
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getRefreshStatus($storeId ='')
    {
        return $this->get('getrefreshstatus', ['query' => compact('storeId')]);
    }

    /**
     * @param string $storeId
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function deactivateStore($storeId = '')
    {
        return $this->post('deactivate', ['form_params' => compact('storeId')]);
    }

    /**
     * @param string $storeId
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function reactivateStore($storeId = '')
    {
        return $this->post('reactivate', ['form_params' => compact('storeId')]);
    }
}
