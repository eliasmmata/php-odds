<?php

use BesoccerOdds\Controllers\{DashboardController,TeamsController, LeaguesController, MatchesController, OddsController, ErrorsController, ProvidersController, InfoController};

    /**
     * Listado de rutas disponibles
     */
    $routesExtra = array(
        /* Rutas de Data Info */
        '/data_info/teams' => array(
            'controller' => TeamsController::class,
            'function' => 'listExtTeams',
            'subRole' => 0,
        ),
        '/data_info/teams/relate' => array(
            'controller' => TeamsController::class,
            'function' => 'relateExtTeam',
            'subRole' => 0,
        ),
        '/data_info/teams/unrelated' => array(
            'controller' => TeamsController::class,
            'function' => 'unrelatedExtTeams',
            'subRole' => 0,
        ),
        '/data_info/leagues' => array(
            'controller' => LeaguesController::class,
            'function' => 'allLeagues',
            'subRole' => 0,
        ),
        '/data_info/leagues/relate' => array(
            'controller' => LeaguesController::class,
            'function' => 'relateCategories',
            'subRole' => 0,
        ),
        '/data_info/leagues/unrelated' => array(
            'controller' => LeaguesController::class,
            'function' => 'unrelatedCategories',
            'subRole' => 0,
        ),
        '/data_info/matches' => array(
            'controller' => MatchesController::class,
            'function' => 'dataInfoMatches',
            'subRole' => 0,
        ),
        '/data_info/matches/relate' => array(
            'controller' => MatchesController::class,
            'function' => 'relateExtMatch',
            'subRole' => 0,
        ),
        '/data_info/matches/unrelated' => array(
            'controller' => MatchesController::class,
            'function' => 'unrelatedExtMatches',
            'subRole' => 0,
        ),
        '/data_info/match_odds' => array(
            'controller' => OddsController::class,
            'function' => 'singleMatchOdds',
            'subRole' => 0,
        ),
        '/data_info/providers' => array(
            'controller' => ProvidersController::class,
            'function' => 'listProviders',
            'subRole' => 0,
        ),
        '/data_info/providers/relate' => array(
            'controller' => ProvidersController::class,
            'function' => 'relateProviders',
            'subRole' => 0,
        ),
        /* Rutas de Football Data */
        '/football_data/teams' => array(
            'controller' => TeamsController::class,
            'function' => 'FootballdataTeams',
            'subRole' => 0,
        ),
        '/football_data/teams/relate' => array(
            'controller' => TeamsController::class,
            'function' => 'relateFdTeam',
            'subRole' => 0,
        ),
        '/football_data/teams/unrelated' => array(
            'controller' => TeamsController::class,
            'function' => 'unrelatedFdTeams',
            'subRole' => 0,
        ),
        '/football_data/leagues' => array(
            'controller' => LeaguesController::class,
            'function' => 'FootballdataLeagues',
            'subRole' => 0,
        ),
        '/football_data/matches' => array(
            'controller' => MatchesController::class,
            'function' => 'relatedFdMatches',
            'subRole' => 0,
        ),
        '/football_data/matches/relate' => array(
            'controller' => MatchesController::class,
            'function' => 'relateFdExtMatch',
            'subRole' => 0,
        ),
        '/football_data/matches/unrelated' => array(
            'controller' => MatchesController::class,
            'function' => 'unrelatedFdMatches',
            'subRole' => 0,
        ),
        '/football_data/match_odds' => array(
            'controller' => OddsController::class,
            'function' => 'listOdds',
            'subRole' => 0,
        ),
        /* Rutas de Goalserve */
        '/goalserve/errors' => array(
            'controller' => ErrorsController::class,
            'function' => 'listErrors',
            'subRole' => 0,
        ),
        '/goalserve/info' => array(
            'controller' => InfoController::class,
            'function' => 'infoGs',
            'subRole' => 0,
        ),
        /* Rutas de Enetpulse */
        '/enetpulse/info' => array(
            'controller' => InfoController::class,
            'function' => 'infoEp',
            'subRole' => 0,
        )
    );
?>