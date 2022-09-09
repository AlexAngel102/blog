<?php

function sortDeliveryMethods(array $deliveryMethods): array
{
    foreach ($deliveryMethods as $method) {
        $code = $method['code'];
        foreach ($method['customer_costs'] as $k => $v) {
            $result[$k][$code] = $v;
        }
    }
    return $result;
}