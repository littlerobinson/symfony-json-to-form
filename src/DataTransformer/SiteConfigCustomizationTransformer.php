<?php

namespace App\DataTransformer;

use App\Dto\SiteConfigCustomizationDto;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Transform the SiteConfig custom field json <-> entity
 * Class SiteConfigCustomizationTransformer
 * @package App\DataTransformer
 */
final class SiteConfigCustomizationTransformer implements DataTransformerInterface
{

    private $customizationDto;

    /**
     * Transform the SiteConfig json custom field in a form
     * {@inheritdoc}
     */
    public function transform($data, string $to, array $context = [])
    {
        $this->customizationDto = new SiteConfigCustomizationDto();
        if (SiteConfigCustomizationDto::class === $to && is_object($data)) {
            $this->customizationDto->primary = (isset($data->primary)) ? $data->primary : '';
            $this->customizationDto->fontTitle = (isset($data->fontTitle)) ? $data->fontTitle : '';
            $this->customizationDto->fontBody = (isset($data->fontBody)) ? $data->fontBody : '';
            $this->customizationDto->navBackground = (isset($data->navBackground)) ? $data->navBackground : '';
            $this->customizationDto->navColor = (isset($data->navColor)) ? $data->navColor : '';
            $this->customizationDto->navIcon = (isset($data->navIcon)) ? $data->navIcon : '';
            $this->customizationDto->btnResaleBackground = (isset($data->btnResaleBackground)) ? $data->btnResaleBackground : '';
            $this->customizationDto->btnRound = (isset($data->btnRound)) ? $data->btnRound : '';
            $this->customizationDto->footerBackground = (isset($data->footerBackground)) ? $data->footerBackground : '';
            $this->customizationDto->footerColor = (isset($data->footerColor)) ? $data->footerColor : '';
        }

        return $this->customizationDto;
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($data, string $to, array $context = [])
    {
        $customString = null;
        if (get_class($data) === SiteConfigCustomizationDto::class) {
            $customString = json_encode($data);
        }
        /// if response have the good return type, return the response
        if (gettype($customString) === $to) {
            return $customString;
        }
        return null;
    }

}