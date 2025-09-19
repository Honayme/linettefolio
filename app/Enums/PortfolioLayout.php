<?php

namespace App\Enums;

// On déclare une Énumération (un ensemble de valeurs fixes)
// Le ": string" signifie que chaque cas aura une valeur de type chaîne de caractères.
enum PortfolioLayout: string
{
    // Voici les seuls cas/valeurs possibles pour notre énumération.
    // En majuscules par convention pour le nom du cas.
    // En minuscules pour la valeur réelle qui sera stockée en base de données.

    case IMAGE = 'image';
    case VIDEO = 'video';
    case PRESENTATION = 'presentation';
}
