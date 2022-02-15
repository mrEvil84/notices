<?php
// Strategia, pozwala zdef. rodzinę algorytmów umieścić je w osobnych klasach , uczynić obiekty tych klas wymienialnymi

// Zastosowanie:
//
// 1. Stosuj wzorzec Strategia gdy chcesz używać różnych wariantów jednego algorytmu w obrębie obiektu i
// zyskać możliwość zmiany wyboru wariantu w trakcie działania programu.
// 2. Warto stosować ten wzorzec gdy, masz w programie wiele podobnych klas,
// różniących się jedynie sposobem wykonywania jakichś zadań.
// 3. Strategia pozwala odizolować logikę biznesową klasy od szczegółów implementacyjnych algorytmów,
// które nie są istotne w kontekście tej logiki.
// 4. Stosuj ten wzorzec gd,y twoja klasa zawiera duży operator warunkowy,
// którego zadaniem jest wybór odpowiedniego wariantu tego samego algorytmu.

interface RouteStrategy
{
    public function buildRoute(string $route): string;
}

class RoadRouteStrategy implements RouteStrategy
{
    public function buildRoute(string $route): string
    {
        return $route . ' : car route';
    }
}

class PublicTransportStrategy implements RouteStrategy
{
    public function buildRoute(string $route): string
    {
        return $route . ' public stransport';
    }

}

class WalkingStrategy implements RouteStrategy
{
    public function buildRoute(string $route): string
    {
        return $route . ' walking';
    }
}

class Navigator
{
    private RouteStrategy $routeStrategy;
    private string $data;

    public function __construct(RouteStrategy $routeStrategy)
    {
        $this->routeStrategy = $routeStrategy;
    }

    public function buildRoute(string $route): string
    {
        return $this->routeStrategy->buildRoute($route);
    }

    public function setRouteStrategy(RouteStrategy $routeStrategy): void
    {
        $this->routeStrategy = $routeStrategy;
    }

    public function setData(string $data): void
    {
        $this->data = $data;
    }
}

$nav = new Navigator(new PublicTransportStrategy());

$routeDescription = $nav->buildRoute('ul.Majowa24');
var_dump($routeDescription);

$nav->setRouteStrategy(new WalkingStrategy());
$routeDescription = $nav->buildRoute('ul.Majowa24');

var_dump($routeDescription);