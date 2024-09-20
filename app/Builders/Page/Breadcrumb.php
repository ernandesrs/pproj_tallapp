<?php

namespace App\Builders\Page;

class Breadcrumb
{
    /**
     * Items
     * @var array
     */
    public array $items = [];

    /**
     * Constructor
     * @param string $homeRouteName
     */
    function __construct(public string $homeRouteName, public array $homeRouteParams = [])
    {
    }

    /**
     * Add a breadcrumb item
     * @param string $label
     * @param array $route
     * @return Breadcrumb
     */
    function add(string $label, array $route = ['name' => null, 'params' => []])
    {
        throw_if(empty($route['name']), 'Requires a route name in $route["name"]');

        $this->items[] = (object) [
            'label' => $label,
            'route' => $route
        ];

        return $this;
    }

    /**
     * Get
     * @param bool $withoutHome
     * @return array
     */
    function get(bool $withoutHome = false)
    {
        return $withoutHome ? $this->items : [
            [
                'label' => 'Home',
                'route' => (object) [
                    'name' => $this->homeRouteName,
                    'params' => $this->homeRouteParams
                ]
            ],
            ...$this->items
        ];
    }

    /**
     * Breadcrumb array to title string
     * @return string
     */
    function getAsTitle()
    {
        return implode(
            ' - ',
            array_map(
                fn($item) => $item->label,
                $this->get(!\Route::currentRouteName() == $this->homeRouteName ? false : true)
            )
        );
    }
}
