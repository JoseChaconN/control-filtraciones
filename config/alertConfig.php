<?php

namespace App\Config;

class AlertConfig
{
    const CHANNELS = [
        ['id' => 1, 'name' => 'Email'],
        ['id' => 2, 'name' => 'Whatsapp'],
        ['id' => 3, 'name' => 'Mensaje de Texto'],
    ];

    const TYPES = [
        ['id' => 1, 'name' => 'Inicio de Riego'],
        ['id' => 2, 'name' => 'Fin de Riego'],
        ['id' => 3, 'name' => 'Flujo Bajo'],
        ['id' => 4, 'name' => 'Flujo Alto'],
        ['id' => 5, 'name' => 'Tiempo sin conexion'],
        ['id' => 6, 'name' => 'Inicio de conexion'],
    ];

    const LEVELS = [
        ['id' => 1, 'name' => 'Informativo'],
        ['id' => 2, 'name' => 'Advertencia'],
        ['id' => 3, 'name' => 'Crítico'],
        ['id' => 4, 'name' => 'Error'],
        ['id' => 5, 'name' => 'Mantenimiento'],
    ];
}