<?php
// require_once('/vendor/autoload.php');

    function norm()
    {
        // Configure API key authorization: Bearer
        $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'XXXXXXXXXXXXX.XXXXXXXXXXXXX.XXXXXXXXXXXX');
        print_r($config);
        // Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
        // $config = Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

        $apiInvoiceInstance = new Swagger\Client\Api\SfeInvoiceApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new GuzzleHttp\Client(array('verify'=> false)),
            $config
        );

        $apiInfoInstance = new Swagger\Client\Api\SfeInfoApi(
            // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
            // This is optional, `GuzzleHttp\Client` will be used as default.
            new GuzzleHttp\Client(array('verify'=> false)),
            $config
        );

        //INFO
        try {
            $infoResponseDto = $apiInfoInstance->apiInfoStatusGet();
            print_r($infoResponseDto);
        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoiceGet: ', $e->getMessage(), PHP_EOL;
        }

        try {
            $invoiceTypesDto = $apiInfoInstance->apiInfoInvoiceTypesGet();
            print_r($invoiceTypesDto);
        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoiceGet: ', $e->getMessage(), PHP_EOL;
        }

        try {
            $taxGroupsDto = $apiInfoInstance->apiInfoTaxGroupsGet();
            print_r($taxGroupsDto);
        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoiceGet: ', $e->getMessage(), PHP_EOL;
        }

        try {
            $paymentTypesDto = $apiInfoInstance->apiInfoPaymentTypesGet();
            print_r($paymentTypesDto);
        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoiceGet: ', $e->getMessage(), PHP_EOL;
        }

        //INVOICE
        try {
            $statusReponseDto = $apiInvoiceInstance->apiInvoiceGet();
            print_r($statusReponseDto);
        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoiceGet: ', $e->getMessage(), PHP_EOL;
        }


        $body = new \Swagger\Client\Model\InvoiceRequestDataDto(); // \Swagger\Client\Model\InvoiceRequestDataDto |
        $body->setIfu('XXXXXXXXXXXX');//YOUR IFU HERE

        $operatorDto = new \Swagger\Client\Model\OperatorDto();
        $operatorDto->setName('Test');
        $body->setOperator($operatorDto);

        $body->setType(Swagger\Client\Model\InvoiceTypeEnum::FV);

        $items = array();

        $item1 = new \Swagger\Client\Model\ItemDto();
        $item1->setName("Jus d'orange");
        $item1->setPrice(1200);
        $item1->setQuantity(3);
        $item1->setTaxGroup(Swagger\Client\Model\TaxGroupTypeEnum::B);
        array_push($items, $item1);

        $item2 = new \Swagger\Client\Model\ItemDto();
        $item2->setName("Article exonere");
        $item2->setPrice(800);
        $item2->setQuantity(2.5);
        $item2->setTaxGroup(Swagger\Client\Model\TaxGroupTypeEnum::A);
        array_push($items, $item2);

        $body->setItems($items);


        try {
            $invoiceResponseDto = $apiInvoiceInstance->apiInvoicePost($body);
            print_r($invoiceResponseDto);
        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoicePost: ', $e->getMessage(), PHP_EOL;
        }


        $uid = $invoiceResponseDto['uid']; // string |
        if (!is_null($uid)){

        try {
            $invoiceDetailsDto = $apiInvoiceInstance->apiInvoiceUidGet($uid);
            print_r($invoiceDetailsDto);

                try {
                    $securityElementsDto = $apiInvoiceInstance->apiInvoiceUidConfirmPut($uid);
                    print_r($securityElementsDto);
                } catch (Exception $e) {
                    echo 'Exception when calling SfeInvoiceApi->apiInvoiceUidConfirmPut: ', $e->getMessage(), PHP_EOL;
                }

        } catch (Exception $e) {
            echo 'Exception when calling SfeInvoiceApi->apiInvoiceUidConfirmPut: ', $e->getMessage(), PHP_EOL;
        }


        }
    }
