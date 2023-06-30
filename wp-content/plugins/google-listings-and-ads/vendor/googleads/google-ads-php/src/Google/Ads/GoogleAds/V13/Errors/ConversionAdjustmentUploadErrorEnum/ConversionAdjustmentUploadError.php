<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v13/errors/conversion_adjustment_upload_error.proto

namespace Google\Ads\GoogleAds\V13\Errors\ConversionAdjustmentUploadErrorEnum;

use UnexpectedValueException;

/**
 * Enum describing possible conversion adjustment upload errors.
 *
 * Protobuf type <code>google.ads.googleads.v13.errors.ConversionAdjustmentUploadErrorEnum.ConversionAdjustmentUploadError</code>
 */
class ConversionAdjustmentUploadError
{
    /**
     * Not specified.
     *
     * Generated from protobuf enum <code>UNSPECIFIED = 0;</code>
     */
    const UNSPECIFIED = 0;
    /**
     * The received error code is not known in this version.
     *
     * Generated from protobuf enum <code>UNKNOWN = 1;</code>
     */
    const UNKNOWN = 1;
    /**
     * The specified conversion action was created too recently.
     * Try the upload again after 4-6 hours have passed since the
     * conversion action was created.
     *
     * Generated from protobuf enum <code>TOO_RECENT_CONVERSION_ACTION = 2;</code>
     */
    const TOO_RECENT_CONVERSION_ACTION = 2;
    /**
     * No conversion action of a supported ConversionActionType that matches the
     * provided information can be found for the customer.
     *
     * Generated from protobuf enum <code>INVALID_CONVERSION_ACTION = 3;</code>
     */
    const INVALID_CONVERSION_ACTION = 3;
    /**
     * A retraction was already reported for this conversion.
     *
     * Generated from protobuf enum <code>CONVERSION_ALREADY_RETRACTED = 4;</code>
     */
    const CONVERSION_ALREADY_RETRACTED = 4;
    /**
     * A conversion for the supplied combination of conversion
     * action and conversion identifier could not be found.
     *
     * Generated from protobuf enum <code>CONVERSION_NOT_FOUND = 5;</code>
     */
    const CONVERSION_NOT_FOUND = 5;
    /**
     * The specified conversion has already expired. Conversions expire after 55
     * days, after which adjustments cannot be reported against them.
     *
     * Generated from protobuf enum <code>CONVERSION_EXPIRED = 6;</code>
     */
    const CONVERSION_EXPIRED = 6;
    /**
     * The supplied adjustment date time precedes that of the original
     * conversion.
     *
     * Generated from protobuf enum <code>ADJUSTMENT_PRECEDES_CONVERSION = 7;</code>
     */
    const ADJUSTMENT_PRECEDES_CONVERSION = 7;
    /**
     * A restatement with a more recent adjustment date time was already
     * reported for this conversion.
     *
     * Generated from protobuf enum <code>MORE_RECENT_RESTATEMENT_FOUND = 8;</code>
     */
    const MORE_RECENT_RESTATEMENT_FOUND = 8;
    /**
     * The conversion was created too recently.
     *
     * Generated from protobuf enum <code>TOO_RECENT_CONVERSION = 9;</code>
     */
    const TOO_RECENT_CONVERSION = 9;
    /**
     * Restatements cannot be reported for a conversion action that always uses
     * the default value.
     *
     * Generated from protobuf enum <code>CANNOT_RESTATE_CONVERSION_ACTION_THAT_ALWAYS_USES_DEFAULT_CONVERSION_VALUE = 10;</code>
     */
    const CANNOT_RESTATE_CONVERSION_ACTION_THAT_ALWAYS_USES_DEFAULT_CONVERSION_VALUE = 10;
    /**
     * The request contained more than 2000 adjustments.
     *
     * Generated from protobuf enum <code>TOO_MANY_ADJUSTMENTS_IN_REQUEST = 11;</code>
     */
    const TOO_MANY_ADJUSTMENTS_IN_REQUEST = 11;
    /**
     * The conversion has been adjusted too many times.
     *
     * Generated from protobuf enum <code>TOO_MANY_ADJUSTMENTS = 12;</code>
     */
    const TOO_MANY_ADJUSTMENTS = 12;
    /**
     * A restatement with this timestamp already exists for this conversion. To
     * upload another adjustment, use a different timestamp.
     *
     * Generated from protobuf enum <code>RESTATEMENT_ALREADY_EXISTS = 13;</code>
     */
    const RESTATEMENT_ALREADY_EXISTS = 13;
    /**
     * This adjustment has the same timestamp as another adjustment in the
     * request for this conversion. To upload another adjustment, use a
     * different timestamp.
     *
     * Generated from protobuf enum <code>DUPLICATE_ADJUSTMENT_IN_REQUEST = 14;</code>
     */
    const DUPLICATE_ADJUSTMENT_IN_REQUEST = 14;
    /**
     * The customer has not accepted the customer data terms in the conversion
     * settings page.
     *
     * Generated from protobuf enum <code>CUSTOMER_NOT_ACCEPTED_CUSTOMER_DATA_TERMS = 15;</code>
     */
    const CUSTOMER_NOT_ACCEPTED_CUSTOMER_DATA_TERMS = 15;
    /**
     * The enhanced conversion settings of the conversion action supplied is
     * not eligible for enhancements.
     *
     * Generated from protobuf enum <code>CONVERSION_ACTION_NOT_ELIGIBLE_FOR_ENHANCEMENT = 16;</code>
     */
    const CONVERSION_ACTION_NOT_ELIGIBLE_FOR_ENHANCEMENT = 16;
    /**
     * The provided user identifier is not a SHA-256 hash. It is either unhashed
     * or hashed using a different hash function.
     *
     * Generated from protobuf enum <code>INVALID_USER_IDENTIFIER = 17;</code>
     */
    const INVALID_USER_IDENTIFIER = 17;
    /**
     * The provided user identifier is not supported.
     * ConversionAdjustmentUploadService only supports hashed_email,
     * hashed_phone_number, and address_info.
     *
     * Generated from protobuf enum <code>UNSUPPORTED_USER_IDENTIFIER = 18;</code>
     */
    const UNSUPPORTED_USER_IDENTIFIER = 18;
    /**
     * Cannot set both gclid_date_time_pair and order_id.
     *
     * Generated from protobuf enum <code>GCLID_DATE_TIME_PAIR_AND_ORDER_ID_BOTH_SET = 20;</code>
     */
    const GCLID_DATE_TIME_PAIR_AND_ORDER_ID_BOTH_SET = 20;
    /**
     * An enhancement with this conversion action and order_id already exists
     * for this conversion.
     *
     * Generated from protobuf enum <code>CONVERSION_ALREADY_ENHANCED = 21;</code>
     */
    const CONVERSION_ALREADY_ENHANCED = 21;
    /**
     * This enhancement has the same conversion action and order_id as
     * another enhancement in the request.
     *
     * Generated from protobuf enum <code>DUPLICATE_ENHANCEMENT_IN_REQUEST = 22;</code>
     */
    const DUPLICATE_ENHANCEMENT_IN_REQUEST = 22;
    /**
     * Per our customer data policies, enhancement has been prohibited in your
     * account. If you have any questions, contact your Google
     * representative.
     *
     * Generated from protobuf enum <code>CUSTOMER_DATA_POLICY_PROHIBITS_ENHANCEMENT = 23;</code>
     */
    const CUSTOMER_DATA_POLICY_PROHIBITS_ENHANCEMENT = 23;
    /**
     * The conversion adjustment is for a conversion action of type WEBPAGE, but
     * does not have an order_id. The order_id is required for an adjustment for
     * a WEBPAGE conversion action.
     *
     * Generated from protobuf enum <code>MISSING_ORDER_ID_FOR_WEBPAGE = 24;</code>
     */
    const MISSING_ORDER_ID_FOR_WEBPAGE = 24;
    /**
     * The order_id contains personally identifiable information (PII), such as
     * an email address or phone number.
     *
     * Generated from protobuf enum <code>ORDER_ID_CONTAINS_PII = 25;</code>
     */
    const ORDER_ID_CONTAINS_PII = 25;

    private static $valueToName = [
        self::UNSPECIFIED => 'UNSPECIFIED',
        self::UNKNOWN => 'UNKNOWN',
        self::TOO_RECENT_CONVERSION_ACTION => 'TOO_RECENT_CONVERSION_ACTION',
        self::INVALID_CONVERSION_ACTION => 'INVALID_CONVERSION_ACTION',
        self::CONVERSION_ALREADY_RETRACTED => 'CONVERSION_ALREADY_RETRACTED',
        self::CONVERSION_NOT_FOUND => 'CONVERSION_NOT_FOUND',
        self::CONVERSION_EXPIRED => 'CONVERSION_EXPIRED',
        self::ADJUSTMENT_PRECEDES_CONVERSION => 'ADJUSTMENT_PRECEDES_CONVERSION',
        self::MORE_RECENT_RESTATEMENT_FOUND => 'MORE_RECENT_RESTATEMENT_FOUND',
        self::TOO_RECENT_CONVERSION => 'TOO_RECENT_CONVERSION',
        self::CANNOT_RESTATE_CONVERSION_ACTION_THAT_ALWAYS_USES_DEFAULT_CONVERSION_VALUE => 'CANNOT_RESTATE_CONVERSION_ACTION_THAT_ALWAYS_USES_DEFAULT_CONVERSION_VALUE',
        self::TOO_MANY_ADJUSTMENTS_IN_REQUEST => 'TOO_MANY_ADJUSTMENTS_IN_REQUEST',
        self::TOO_MANY_ADJUSTMENTS => 'TOO_MANY_ADJUSTMENTS',
        self::RESTATEMENT_ALREADY_EXISTS => 'RESTATEMENT_ALREADY_EXISTS',
        self::DUPLICATE_ADJUSTMENT_IN_REQUEST => 'DUPLICATE_ADJUSTMENT_IN_REQUEST',
        self::CUSTOMER_NOT_ACCEPTED_CUSTOMER_DATA_TERMS => 'CUSTOMER_NOT_ACCEPTED_CUSTOMER_DATA_TERMS',
        self::CONVERSION_ACTION_NOT_ELIGIBLE_FOR_ENHANCEMENT => 'CONVERSION_ACTION_NOT_ELIGIBLE_FOR_ENHANCEMENT',
        self::INVALID_USER_IDENTIFIER => 'INVALID_USER_IDENTIFIER',
        self::UNSUPPORTED_USER_IDENTIFIER => 'UNSUPPORTED_USER_IDENTIFIER',
        self::GCLID_DATE_TIME_PAIR_AND_ORDER_ID_BOTH_SET => 'GCLID_DATE_TIME_PAIR_AND_ORDER_ID_BOTH_SET',
        self::CONVERSION_ALREADY_ENHANCED => 'CONVERSION_ALREADY_ENHANCED',
        self::DUPLICATE_ENHANCEMENT_IN_REQUEST => 'DUPLICATE_ENHANCEMENT_IN_REQUEST',
        self::CUSTOMER_DATA_POLICY_PROHIBITS_ENHANCEMENT => 'CUSTOMER_DATA_POLICY_PROHIBITS_ENHANCEMENT',
        self::MISSING_ORDER_ID_FOR_WEBPAGE => 'MISSING_ORDER_ID_FOR_WEBPAGE',
        self::ORDER_ID_CONTAINS_PII => 'ORDER_ID_CONTAINS_PII',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ConversionAdjustmentUploadError::class, \Google\Ads\GoogleAds\V13\Errors\ConversionAdjustmentUploadErrorEnum_ConversionAdjustmentUploadError::class);

