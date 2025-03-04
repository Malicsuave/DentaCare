<?php

declare(strict_types=1);

/*
 * PaypalServerSdkLib
 *
 * This file was automatically generated by APIMATIC v3.0 ( https://www.apimatic.io ).
 */

namespace PaypalServerSdkLib\Models\Builders;

use Core\Utils\CoreHelper;
use PaypalServerSdkLib\Models\VenmoWalletVaultAttributes;

/**
 * Builder for model VenmoWalletVaultAttributes
 *
 * @see VenmoWalletVaultAttributes
 */
class VenmoWalletVaultAttributesBuilder
{
    /**
     * @var VenmoWalletVaultAttributes
     */
    private $instance;

    private function __construct(VenmoWalletVaultAttributes $instance)
    {
        $this->instance = $instance;
    }

    /**
     * Initializes a new venmo wallet vault attributes Builder object.
     */
    public static function init(string $storeInVault, string $usageType): self
    {
        return new self(new VenmoWalletVaultAttributes($storeInVault, $usageType));
    }

    /**
     * Sets description field.
     */
    public function description(?string $value): self
    {
        $this->instance->setDescription($value);
        return $this;
    }

    /**
     * Sets usage pattern field.
     */
    public function usagePattern(?string $value): self
    {
        $this->instance->setUsagePattern($value);
        return $this;
    }

    /**
     * Sets customer type field.
     */
    public function customerType(?string $value): self
    {
        $this->instance->setCustomerType($value);
        return $this;
    }

    /**
     * Sets permit multiple payment tokens field.
     */
    public function permitMultiplePaymentTokens(?bool $value): self
    {
        $this->instance->setPermitMultiplePaymentTokens($value);
        return $this;
    }

    /**
     * Initializes a new venmo wallet vault attributes object.
     */
    public function build(): VenmoWalletVaultAttributes
    {
        return CoreHelper::clone($this->instance);
    }
}
