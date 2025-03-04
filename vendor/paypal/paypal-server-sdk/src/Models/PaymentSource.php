<?php

declare(strict_types=1);

/*
 * PaypalServerSdkLib
 *
 * This file was automatically generated by APIMATIC v3.0 ( https://www.apimatic.io ).
 */

namespace PaypalServerSdkLib\Models;

use stdClass;

/**
 * The payment source definition.
 */
class PaymentSource implements \JsonSerializable
{
    /**
     * @var CardRequest|null
     */
    private $card;

    /**
     * @var Token|null
     */
    private $token;

    /**
     * @var PaypalWallet|null
     */
    private $paypal;

    /**
     * @var BancontactPaymentRequest|null
     */
    private $bancontact;

    /**
     * @var BlikPaymentRequest|null
     */
    private $blik;

    /**
     * @var EpsPaymentRequest|null
     */
    private $eps;

    /**
     * @var GiropayPaymentRequest|null
     */
    private $giropay;

    /**
     * @var IdealPaymentRequest|null
     */
    private $ideal;

    /**
     * @var MybankPaymentRequest|null
     */
    private $mybank;

    /**
     * @var P24PaymentRequest|null
     */
    private $p24;

    /**
     * @var SofortPaymentRequest|null
     */
    private $sofort;

    /**
     * @var TrustlyPaymentRequest|null
     */
    private $trustly;

    /**
     * @var ApplePayRequest|null
     */
    private $applePay;

    /**
     * @var GooglePayRequest|null
     */
    private $googlePay;

    /**
     * @var VenmoWalletRequest|null
     */
    private $venmo;

    /**
     * Returns Card.
     * The payment card to use to fund a payment. Can be a credit or debit card.<blockquote><strong>Note:
     * </strong> Passing card number, cvv and expiry directly via the API requires <a href="https://www.
     * pcisecuritystandards.org/pci_security/completing_self_assessment"> PCI SAQ D compliance</a>.
     * <br>*PayPal offers a mechanism by which you do not have to take on the <strong>PCI SAQ D</strong>
     * burden by using hosted fields - refer to <a href="https://developer.paypal.
     * com/docs/checkout/advanced/integrate/">this Integration Guide</a>*.</blockquote>
     */
    public function getCard(): ?CardRequest
    {
        return $this->card;
    }

    /**
     * Sets Card.
     * The payment card to use to fund a payment. Can be a credit or debit card.<blockquote><strong>Note:
     * </strong> Passing card number, cvv and expiry directly via the API requires <a href="https://www.
     * pcisecuritystandards.org/pci_security/completing_self_assessment"> PCI SAQ D compliance</a>.
     * <br>*PayPal offers a mechanism by which you do not have to take on the <strong>PCI SAQ D</strong>
     * burden by using hosted fields - refer to <a href="https://developer.paypal.
     * com/docs/checkout/advanced/integrate/">this Integration Guide</a>*.</blockquote>
     *
     * @maps card
     */
    public function setCard(?CardRequest $card): void
    {
        $this->card = $card;
    }

    /**
     * Returns Token.
     * The tokenized payment source to fund a payment.
     */
    public function getToken(): ?Token
    {
        return $this->token;
    }

    /**
     * Sets Token.
     * The tokenized payment source to fund a payment.
     *
     * @maps token
     */
    public function setToken(?Token $token): void
    {
        $this->token = $token;
    }

    /**
     * Returns Paypal.
     * A resource that identifies a PayPal Wallet is used for payment.
     */
    public function getPaypal(): ?PaypalWallet
    {
        return $this->paypal;
    }

    /**
     * Sets Paypal.
     * A resource that identifies a PayPal Wallet is used for payment.
     *
     * @maps paypal
     */
    public function setPaypal(?PaypalWallet $paypal): void
    {
        $this->paypal = $paypal;
    }

    /**
     * Returns Bancontact.
     * Information needed to pay using Bancontact.
     */
    public function getBancontact(): ?BancontactPaymentRequest
    {
        return $this->bancontact;
    }

    /**
     * Sets Bancontact.
     * Information needed to pay using Bancontact.
     *
     * @maps bancontact
     */
    public function setBancontact(?BancontactPaymentRequest $bancontact): void
    {
        $this->bancontact = $bancontact;
    }

    /**
     * Returns Blik.
     * Information needed to pay using BLIK.
     */
    public function getBlik(): ?BlikPaymentRequest
    {
        return $this->blik;
    }

    /**
     * Sets Blik.
     * Information needed to pay using BLIK.
     *
     * @maps blik
     */
    public function setBlik(?BlikPaymentRequest $blik): void
    {
        $this->blik = $blik;
    }

    /**
     * Returns Eps.
     * Information needed to pay using eps.
     */
    public function getEps(): ?EpsPaymentRequest
    {
        return $this->eps;
    }

    /**
     * Sets Eps.
     * Information needed to pay using eps.
     *
     * @maps eps
     */
    public function setEps(?EpsPaymentRequest $eps): void
    {
        $this->eps = $eps;
    }

    /**
     * Returns Giropay.
     * Information needed to pay using giropay.
     */
    public function getGiropay(): ?GiropayPaymentRequest
    {
        return $this->giropay;
    }

    /**
     * Sets Giropay.
     * Information needed to pay using giropay.
     *
     * @maps giropay
     */
    public function setGiropay(?GiropayPaymentRequest $giropay): void
    {
        $this->giropay = $giropay;
    }

    /**
     * Returns Ideal.
     * Information needed to pay using iDEAL.
     */
    public function getIdeal(): ?IdealPaymentRequest
    {
        return $this->ideal;
    }

    /**
     * Sets Ideal.
     * Information needed to pay using iDEAL.
     *
     * @maps ideal
     */
    public function setIdeal(?IdealPaymentRequest $ideal): void
    {
        $this->ideal = $ideal;
    }

    /**
     * Returns Mybank.
     * Information needed to pay using MyBank.
     */
    public function getMybank(): ?MybankPaymentRequest
    {
        return $this->mybank;
    }

    /**
     * Sets Mybank.
     * Information needed to pay using MyBank.
     *
     * @maps mybank
     */
    public function setMybank(?MybankPaymentRequest $mybank): void
    {
        $this->mybank = $mybank;
    }

    /**
     * Returns P 24.
     * Information needed to pay using P24 (Przelewy24).
     */
    public function getP24(): ?P24PaymentRequest
    {
        return $this->p24;
    }

    /**
     * Sets P 24.
     * Information needed to pay using P24 (Przelewy24).
     *
     * @maps p24
     */
    public function setP24(?P24PaymentRequest $p24): void
    {
        $this->p24 = $p24;
    }

    /**
     * Returns Sofort.
     * Information needed to pay using Sofort.
     */
    public function getSofort(): ?SofortPaymentRequest
    {
        return $this->sofort;
    }

    /**
     * Sets Sofort.
     * Information needed to pay using Sofort.
     *
     * @maps sofort
     */
    public function setSofort(?SofortPaymentRequest $sofort): void
    {
        $this->sofort = $sofort;
    }

    /**
     * Returns Trustly.
     * Information needed to pay using Trustly.
     */
    public function getTrustly(): ?TrustlyPaymentRequest
    {
        return $this->trustly;
    }

    /**
     * Sets Trustly.
     * Information needed to pay using Trustly.
     *
     * @maps trustly
     */
    public function setTrustly(?TrustlyPaymentRequest $trustly): void
    {
        $this->trustly = $trustly;
    }

    /**
     * Returns Apple Pay.
     * Information needed to pay using ApplePay.
     */
    public function getApplePay(): ?ApplePayRequest
    {
        return $this->applePay;
    }

    /**
     * Sets Apple Pay.
     * Information needed to pay using ApplePay.
     *
     * @maps apple_pay
     */
    public function setApplePay(?ApplePayRequest $applePay): void
    {
        $this->applePay = $applePay;
    }

    /**
     * Returns Google Pay.
     * Information needed to pay using Google Pay.
     */
    public function getGooglePay(): ?GooglePayRequest
    {
        return $this->googlePay;
    }

    /**
     * Sets Google Pay.
     * Information needed to pay using Google Pay.
     *
     * @maps google_pay
     */
    public function setGooglePay(?GooglePayRequest $googlePay): void
    {
        $this->googlePay = $googlePay;
    }

    /**
     * Returns Venmo.
     * Information needed to pay using Venmo.
     */
    public function getVenmo(): ?VenmoWalletRequest
    {
        return $this->venmo;
    }

    /**
     * Sets Venmo.
     * Information needed to pay using Venmo.
     *
     * @maps venmo
     */
    public function setVenmo(?VenmoWalletRequest $venmo): void
    {
        $this->venmo = $venmo;
    }

    /**
     * Encode this object to JSON
     *
     * @param bool $asArrayWhenEmpty Whether to serialize this model as an array whenever no fields
     *        are set. (default: false)
     *
     * @return array|stdClass
     */
    #[\ReturnTypeWillChange] // @phan-suppress-current-line PhanUndeclaredClassAttribute for (php < 8.1)
    public function jsonSerialize(bool $asArrayWhenEmpty = false)
    {
        $json = [];
        if (isset($this->card)) {
            $json['card']       = $this->card;
        }
        if (isset($this->token)) {
            $json['token']      = $this->token;
        }
        if (isset($this->paypal)) {
            $json['paypal']     = $this->paypal;
        }
        if (isset($this->bancontact)) {
            $json['bancontact'] = $this->bancontact;
        }
        if (isset($this->blik)) {
            $json['blik']       = $this->blik;
        }
        if (isset($this->eps)) {
            $json['eps']        = $this->eps;
        }
        if (isset($this->giropay)) {
            $json['giropay']    = $this->giropay;
        }
        if (isset($this->ideal)) {
            $json['ideal']      = $this->ideal;
        }
        if (isset($this->mybank)) {
            $json['mybank']     = $this->mybank;
        }
        if (isset($this->p24)) {
            $json['p24']        = $this->p24;
        }
        if (isset($this->sofort)) {
            $json['sofort']     = $this->sofort;
        }
        if (isset($this->trustly)) {
            $json['trustly']    = $this->trustly;
        }
        if (isset($this->applePay)) {
            $json['apple_pay']  = $this->applePay;
        }
        if (isset($this->googlePay)) {
            $json['google_pay'] = $this->googlePay;
        }
        if (isset($this->venmo)) {
            $json['venmo']      = $this->venmo;
        }

        return (!$asArrayWhenEmpty && empty($json)) ? new stdClass() : $json;
    }
}
