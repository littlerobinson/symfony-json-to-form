<?php

namespace App\Entity\Legacy;

use App\DataTransformer\SiteConfigCustomizationTransformer;
use App\Dto\SiteConfigCustomizationDto;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Mixed_;

/**
 * @ORM\Table(name="mb_config")
 * @ORM\Entity(repositoryClass="App\Repository\Legacy\SiteConfigRepository")
 */
class SiteConfig
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=150)
     */
    private $name;

    /**
     * @ORM\Column(name="site_route", type="string", length=50)
     */
    private $route;

    /**
     * @ORM\Column(name="site_name", type="string", length=100)
     */
    private $siteName;

    /**
     * @ORM\Column(name="subdomain", type="string", length=50)
     */
    private $subdomain;

    /**
     * @ORM\Column(name="domain", type="string", length=100, options={"default" : ""})
     */
    private $domain;

    /**
     * @ORM\Column(name="data", type="text")
     */
    private $data;

    /**
     * @ORM\Column(name="custom", type="text")
     */
    private $custom;

    /**
     * Is the custom field as SiteConfigCustomizationDto object
     * @var customDto
     */
    private $customDto;

    /**
     * @ORM\Column(name="version", type="string", length=50)
     */
    private $version;

    /**
     * @ORM\Column(name="is_background_image", type="boolean")
     */
    private $isBackgroundImage;

    /**
     * @ORM\Column(name="is_header_image", type="boolean")
     */
    private $isHeaderImage;

    private $values;


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSiteName(): ?string
    {
        return $this->siteName;
    }

    /**
     * @param string $siteName
     * @return $this
     */
    public function setSiteName(string $siteName): self
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRoute(): ?string
    {
        return $this->route;
    }

    /**
     * @param string $route
     * @return $this
     */
    public function setRoute(string $route): self
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSubdomain(): ?string
    {
        return $this->subdomain;
    }

    /**
     * @param string $subdomain
     * @return $this
     */
    public function setSubdomain(string $subdomain): self
    {
        $this->subdomain = $subdomain;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return $this
     */
    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * @param string $data
     * @return $this
     */
    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * @return mixed
     */
    public function getCustomData()
    {
        return \json_decode($this->custom);
    }

    /**
     * get custom as SiteConfigCustomizationDto object
     * @return SiteConfigCustomizationDto
     */
    public function getCustomDto(): ?SiteConfigCustomizationDto
    {
        $transformer = new SiteConfigCustomizationTransformer();
        return $transformer->transform($this->getCustomData(), SiteConfigCustomizationDto::class);
    }

    /**
     * Set custom with SiteConfigCustomizationDto
     * @param SiteConfigCustomizationDto $customDto
     * @return SiteConfig
     */
    public function setCustomDto(SiteConfigCustomizationDto $customDto): SiteConfig
    {
        $transformer = new SiteConfigCustomizationTransformer();
        $newCustom = $transformer->reverseTransform($customDto, 'string');
        if (null !== $newCustom) {
            $this->setCustom($newCustom);
        }
        return $this;
    }

    /**
     * @param mixed $custom
     * @return SiteConfig
     */
    public function setCustom($custom)
    {
        $this->custom = $custom;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     * @return SiteConfig
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsHeaderImage(): ?bool
    {
        return $this->isHeaderImage;
    }

    /**
     * @param bool $isHeaderImage
     * @return $this
     */
    public function setIsHeaderImage(bool $isHeaderImage): self
    {
        $this->isHeaderImage = $isHeaderImage;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsBackgroundImage(): ?bool
    {
        return $this->isBackgroundImage;
    }

    /**
     * @param bool $isBackgroundImage
     * @return $this
     */
    public function setIsBackgroundImage(bool $isBackgroundImage): self
    {
        $this->isBackgroundImage = $isBackgroundImage;

        return $this;
    }

    /**
     * @return $this
     */
    public function setValues(): self
    {
        $this->values = \json_decode($this->getData());
        return $this;
    }

    /**
     * @return Object|null
     */
    public function getValues(): ?Object
    {
        return $this->values;
    }

    /**
     * @param $key
     * @param null $node
     * @return mixed
     */
    private function getValue($key, $node = null)
    {
        $data = $this->getValues();
        if($node !== null && isset($data->{$node})) {
            $data = isset($data->{$node}->{$key}) ? $data->{$node}->{$key} : null;
        } else {
            $data = isset($data->$key) ? $data->$key : null;
        }
        return $data;
    }


    /**
     * @return string|null
     */
    public function getFeesTypeByTicket(): ?string
    {
        return $this->getValue('frais_traitement_par_billet', 'achat');
    }

    /**
     * @return bool|null
     */
    public function isSwitch(): ?bool
    {
        return (bool)$this->getValue('is_switch');
    }

    /**
     * @return bool|null
     */
    public function isLoginRs(): ?bool
    {
        return (bool)$this->getValue('is_login_rs');
    }

    /**
     * @return bool|null
     */
    public function isEmailEqual(): ?bool
    {
        return (bool)$this->getValue('email_equal', 'revente');
    }

    /**
     * @return bool|null
     * get advert gold status from config
     */
    public function isAdvertGold(): ?bool
    {
        return (bool)$this->getValue('advert_is_gold', 'achat');
    }

    /**
     * @return int|null
     */
    public function getVenueId(): ?int
    {
        return $this->getValue('id_salle');
    }

    /**
     * @return int|null
     */
    public function getEventId(): ?int
    {
        return $this->getValue('id_event');
    }

    /**
     * @return int|null
     */
    public function getArtistId(): ?int
    {
        return $this->getValue('id_artiste');
    }

    /**
     * @return int|null
     */
    public function getFestivalId(): ?int
    {
        return $this->getValue('id_festival');
    }

    /**
     * @return int|null
     */
    public function getCompetitionId(): ?int
    {
        return $this->getValue('id_competition');
    }

    /**
     * @return array|null
     */
    public function getPaymentType(): ?array
    {
        return $this->getValue('types_paiement', 'achat');
    }

    /**
     * @return float
     */
    public function getFeesPercentByTicket()
    {
        return $this->getValue('montant_pourcent_traitement_par_billet', 'achat');
    }

    /**
     * @return float
     */
    public function getFeesFixedByTicket()
    {
        return $this->getValue('montant_fix_traitement_par_billet', 'achat');
    }

    /**
     * @return int|null
     * get nb tickets max in cart
     */
    public function getNbTicketMaxInCart(): ?int
    {
        return $this->getValue('nb_billets_achat_max', 'achat');
    }

    /**
     * @return int|null
     * get site profile
     */
    public function getSiteProfile(): ?int
    {
        return $this->getValue('profil_parent');
    }

    /**
     * @return array|null
     */
    public function getRs(): ?array
    {
        return $this->getValue('rs');
    }

    /**
     * @return array|null
     * get resale send types
     */
    public function getResaleSendType(): ?array
    {
        return $this->getValue('type_envoi', 'revente');
    }

    /**
     * @return array|null
     */
    public function getExternalUrl(): ?array
    {
        return [
            'official_website' => $this->getValue('url_officielle'),
            'official_ticket_office' => $this->getValue('url_billetterie'),
            'official_help' => $this->getValue('url_help')
        ];
    }

    /**
     * @return array|null
     */
    public function getLanguagesUsed(): ?array
    {
        return $this->getValue('languages');
    }

    /**
     * @return string|null
     */
    public function getMailerFrom(): ?string
    {
        return $this->getValue('mailer_from') == '' ? null : $this->getValue('mailer_from');
    }

    /**
     * @return string|null
     */
    public function getMailerConf(): ?string
    {
        return $this->getValue('mailer_conf') == '' ? null : $this->getValue('mailer_conf');
    }

    /**
     * @return bool|null
     */
    public function isMaintenance(): ?bool
    {
        return $this->getValue('is_maintenance');
    }

    /**
     * @return bool|null
     */
    public function isOnline(): ?bool
    {
        return $this->getValue('online');
    }

    /**
     * @return bool|null
     */
    public function authorizeRenaming(): bool
    {
        return $this->getValue('authorize_renaming') !== false;
    }

    public function getCustomCss()
    {
        return $this->getName() . '_' . $this->getVersion();
    }

    /**
     * @return array|null
     */
    public function getAccessTokenList(): ?array
    {
        return array_filter($this->getValue('access_token_list'));
    }

}
