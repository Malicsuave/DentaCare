<?php

declare(strict_types=1);

/*
 * PaypalServerSdkLib
 *
 * This file was automatically generated by APIMATIC v3.0 ( https://www.apimatic.io ).
 */

namespace PaypalServerSdkLib\Models\Builders;

use Core\Utils\CoreHelper;
use PaypalServerSdkLib\Models\Phone;

/**
 * Builder for model Phone
 *
 * @see Phone
 */
class PhoneBuilder
{
    /**
     * @var Phone
     */
    private $instance;

    private function __construct(Phone $instance)
    {
        $this->instance = $instance;
    }

    /**
     * Initializes a new phone Builder object.
     */
    public static function init(string $countryCode, string $nationalNumber): self
    {
        return new self(new Phone($countryCode, $nationalNumber));
    }

    /**
     * Sets extension number field.
     */
    public function extensionNumber(?string $value): self
    {
        $this->instance->setExtensionNumber($value);
        return $this;
    }

    /**
     * Initializes a new phone object.
     */
    public function build(): Phone
    {
        return CoreHelper::clone($this->instance);
    }
}
