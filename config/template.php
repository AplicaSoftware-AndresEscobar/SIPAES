<?php

return [

    /**
     * ------------------------------------------------
     *  Menú de Navegación
     * ------------------------------------------------
     * 
     */
    'sidebar-menu' => [
        /**
         * Inicio, Menú Principal de la Aplicación
         */
        array(
            'name' => 'Menú Principal',
            'url' => 'inicio',
            'icon' => 'fa fa-home'
        ),
        array(
            'name' => 'Personal',
            'url' => '#',
            'icon' => 'fa fa-users',
            'submenu' => [
                array(
                    'name' => 'Administrativos',
                    'url' => '#',
                ),
                array(
                    'name' => 'Coordinadores',
                    'url' => '#',
                ),
                array(
                    'name' => 'Docentes',
                    'url' => '#',
                ),
                array(
                    'name' => 'Configurar',
                    'url' => '#',
                )
            ]
        ),
        array(
            'name' => 'Evaluaciones',
            'url' => '#',
            'icon' => 'fas fa-newspaper',
            'submenu' => [
                array(
                    'name' => 'Formatos',
                    'url' => '#',
                ),
                array(
                    'name' => 'Habilitar Evaluaciones',
                    'url' => '#',
                ),
                array(
                    'name' => 'Resultados',
                    'url' => '#',
                ),
                array(
                    'name' => 'Estudiantes por Docente',
                    'url' => '#',
                ),
                array(
                    'name' => 'Observaciones',
                    'url' => '#',
                ),
                array(
                    'name' => 'Historial por Docente',
                    'url' => '#',
                ),
                array(
                    'name' => 'Consolidado General',
                    'url' => '#',
                ), array(
                    'name' => 'Consolidado',
                    'url' => '#',
                )
            ]
        ),
        array(
            'name' => 'Nómina',
            'url' => '#',
            'icon' => 'fas fa-money-bill',
            'submenu' => [
                array(
                    'name' => 'Parámetros',
                    'url' => '#',
                ),
                array(
                    'name' => 'Docentes',
                    'url' => '#',
                    'submenu' => [
                        array(
                            'name' => 'Tiempo Completo',
                            'url' => '#',
                        ),
                        array(
                            'name' => 'Hora Cátedra',
                            'url' => '#'
                        )
                    ]
                ),
                array(
                    'name' => 'Administrativos',
                    'url' => '#',
                ),
                array(
                    'name' => 'Nómina',
                    'url' => '#',
                ),
                array(
                    'name' => 'Nómina Hora Cátedra',
                    'url' => '#',
                ),
                array(
                    'name' => 'Tira de Pago',
                    'url' => '#',
                ),
            ]
        ),
        array(
            'name' => 'S.G.C',
            'url' => '#',
            'icon' => 'fa fa-check-square',
            'submenu' => [
                array(
                    'name' => 'Acciones Preventivas',
                    'url' => '#'
                ),
                array(
                    'name' => 'Acciones Correctivas',
                    'url' => '#'
                ),
                array(
                    'name' => 'Acciones de Mejora',
                    'url' => '#'
                ),
                array(
                    'name' => 'Control de Documentos',
                    'url' => '#'
                ),
            ]
        )
    ],
];
