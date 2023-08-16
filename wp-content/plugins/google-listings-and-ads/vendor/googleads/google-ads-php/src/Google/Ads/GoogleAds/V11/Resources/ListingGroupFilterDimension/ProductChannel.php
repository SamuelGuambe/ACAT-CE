<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v11/resources/asset_group_listing_group_filter.proto

namespace Google\Ads\GoogleAds\V11\Resources\ListingGroupFilterDimension;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Locality of a product offer.
 *
 * Generated from protobuf message <code>google.ads.googleads.v11.resources.ListingGroupFilterDimension.ProductChannel</code>
 */
class ProductChannel extends \Google\Protobuf\Internal\Message
{
    /**
     * Value of the locality.
     *
     * Generated from protobuf field <code>.google.ads.googleads.v11.enums.ListingGroupFilterProductChannelEnum.ListingGroupFilterProductChannel channel = 1;</code>
     */
    protected $channel = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $channel
     *           Value of the locality.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Ads\GoogleAds\V11\Resources\AssetGroupListingGroupFilter::initOnce();
        parent::__construct($data);
    }

    /**
     * Value of the locality.
     *
     * Generated from protobuf field <code>.google.ads.googleads.v11.enums.ListingGroupFilterProductChannelEnum.ListingGroupFilterProductChannel channel = 1;</code>
     * @return int
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * Value of the locality.
     *
     * Generated from protobuf field <code>.google.ads.googleads.v11.enums.ListingGroupFilterProductChannelEnum.ListingGroupFilterProductChannel channel = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setChannel($var)
    {
        GPBUtil::checkEnum($var, \Google\Ads\GoogleAds\V11\Enums\ListingGroupFilterProductChannelEnum\ListingGroupFilterProductChannel::class);
        $this->channel = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ProductChannel::class, \Google\Ads\GoogleAds\V11\Resources\ListingGroupFilterDimension_ProductChannel::class);

