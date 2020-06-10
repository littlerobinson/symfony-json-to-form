# Symfony Json Form

Symfony Json Form is one of the ways to transform JSON data from a database field into an DTO object usable by a symfony form.
In the source example we have a field named `custom` who is a JSON object for customize website.
It's possible to use with [easyadmin](https://github.com/EasyCorp/EasyAdminBundle).

## 🏁 Requirement

Symfony 4+

## 🚧 Installation

### Create your DTO object

Create your DTO objet as you need.
In my example I create an object like the JSON object :

```json
{
    "primary": "#319794",
    "fontTitle": "roboto",
    "fontBody": "montserrat",
    "navBackground": "#202020",
    "navColor": "#7e7e7e",
    "navIcon": "#7e7e7e",
    "btnResaleBackground": "#b46816",
    "btnRound": "0em",
    "footerBackground": "#262627",
    "footerColor": "#798185"
}
```

```php
final class SiteConfigCustomizationDto
{
    /**
     * @var string
     */
    public $primary;

    /**
     * @var string
     */
    public $fontTitle;

    /**
     * @var string
     */
    public $fontBody;

    /**
     * @var string
     */
    public $navBackground;

    /**
     * @var string
     */
    public $navColor;

    /**
     * @var string
     */
    public $navIcon;

    /**
     * @var string
     */
    public $btnResaleBackground;

    /**
     * @var string
     */
    public $btnRound;

    /**
     * @var string
     */
    public $footerBackground;

    /**
     * @var string
     */
    public $footerColor;
}
```

### Create your DataTransformer.
The `transform` method transform the JSON objet in a PHP object (DTO) :

```php
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
```

The `reverseTransform method` transform the PHP objet in a JSON object :

```php
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
```

### Create your form

Create your like a normal symfony form but use your DTO class instead of an entity.

```php
// Symfony form

public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
        'data_class' => SiteConfigCustomizationDto::class,
        'attr' => ['class' => 'form']
    ]);
}
```

## Usage

Now you can use it.
In my example i create a new class attribut in the entity call `customDto`. It represent the field custom (JSON field) as an object (SiteConfigCustomizationDto).
I create accessors for the `customDto` attribute who use the dataTransformer

```php
/**
 * @var customDto
 */
private $customDto;

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
```

Now I can use it !

In a controller :

```php
$siteConfig = new SiteConfig();

$form = $this->createFormBuilder($siteConfig)
            ->add('name', TextType::class)
            ->add('customDto', SiteConfigCustomizationFormType::class)
            ->add('save', SubmitType::class, ['label' => 'Create'])
            ->getForm();
```

We can also use it in easyadmin :
```yaml
## 
...

form:
    - {property: 'customDto', type: 'App\Form\SiteConfigCustomizationFormType'}
```
