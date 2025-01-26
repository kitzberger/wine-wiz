<?php

return [
    'level' => [
        'question' => 'Wie gut kennen Sie sich mit Wein aus?',
        'options' => [
            'amateur' => [
                'title' => 'Nicht wirklich',
                'description' => 'Ich trinke, was mir schmeckt – Namen und Regionen sind mir egal.',
            ],
            'advanced' => [
                'title' => 'Etwas',
                'description' => 'Ich kenne ein paar Rebsorten und erkenne einen guten Wein, wenn ich ihn probiere.',
            ],
            'expert' => [
                'title' => 'Sehr gut',
                'description' => 'Ich habe ein Gespür für Nuancen, Jahrgänge und die perfekte Speisenbegleitung.',
            ],
        ],
    ],
    'occasion' => [
        'question' => 'Zu welcher Gelegenheit möchten Sie den Wein trinken?',
        'options' => [
            'before' => [
                'title' => 'Erfrischend für die Terasse',
                'description' => 'Ein lockerer Moment, um anzukommen und den Tag hinter sich zu lassen.',
            ],
            'while' => [
                'title' => 'Zum Essen',
                'description' => 'Ein genussvolles Zusammenspiel von Wein und Speisen für den perfekten Tischmoment.',
            ],
            'after' => [
                'title' => 'Als Latenight Drink',
                'description' => 'Ein entspannter Ausklang, um Gespräche und Genuss in Ruhe nachklingen zu lassen.',
            ],
        ],
    ],
    'course' => [
        'question' => 'Zu welchem Essen möchten Sie den Wein?',
        'options' => [
            'starter' => [
                'title' => 'Vorspeise',
                'description' => 'Ein Wein, der leichte Gerichte perfekt ergänzt und den Appetit anregt.',
            ],
            'maincourse' => [
                'title' => 'Hauptspeise',
                'description' => 'Ein Wein, der mit kräftigen Aromen harmoniert und das Hauptgericht ideal begleitet.'
            ],
            'dessert' => [
                'title' => 'Nachtisch',
                'description' => 'Ein süffiger Wein, der die süßen Aromen des Desserts wunderbar unterstreicht.',
            ],
            'all' => [
                'title' => 'Passend zu allen Gängen',
                'description' => 'Ein vielseitiger Wein, der sich nahtlos in jedes Menü einfügt.',
            ],
            'independent' => [
                'title' => 'Unabhängig vom Essen',
                'description' => 'Ein Wein, der zu jeder Gelegenheit passt und sich flexibel mit verschiedenen Speisen kombinieren lässt.'
            ],
        ],
    ],
    'food_starter' => [
        'question' => 'Welche Vorspeise haben Sie gewählt?',
    ],
    'food_maincourse' => [
        'question' => 'Welche Hauptspeise haben Sie gewählt?',
    ],
    'food_dessert' => [
        'question' => 'Welchen Nachtisch haben Sie gewählt?',
    ],
    'color' => [
        'question' => 'Welche Farbe sagt Ihnen am meisten zu?',
        'options' => [
            'green' => [
                'title' => 'Grün',
                'description' => 'Frisch und lebendig, wie ein Spaziergang durch einen Frühlingswald.',
            ],
            'yellow' => [
                'title' => 'Gelb',
                'description' => 'Strahlend und warm, wie die Sonne, die ein Lächeln zaubert.',
            ],
            'orange' => [
                'title' => 'Orange',
                'description' => 'Energiegeladen und fröhlich, wie ein spritziger Sommerabend.',
            ],
            'red' => [
                'title' => 'Rot',
                'description' => 'Leidenschaftlich und kraftvoll, voller Feuer und Intensität.',
            ],
            'plum' => [
                'title' => 'Pflaumig',
                'description' => 'Tief und geheimnisvoll, ein Hauch von Eleganz und Sinnlichkeit.',
            ],
            'purple' => [
                'title' => 'Purpur',
                'description' => 'Kreativ und inspirierend, wie ein Traum voller Fantasie.',
            ],
        ],
    ],
    'strength' => [
        'question' => 'Mögen Sie Ihren Wein eher kräftig oder lieber etwas leichter?',
        'options' => [
            'light' => [
                'title' => 'Leicht',
                'description' => 'Ein frischer, sanfter Wein mit feinen Aromen und einer eleganten Leichtigkeit.',
            ],
            'medium' => [
                'title' => 'Mittel',
                'description' => 'Ein ausgewogener Wein mit harmonischer Fülle und einer angenehmen Tiefe.',
            ],
            'strong' => [
                'title' => 'Stark',
                'description' => 'Ein kraftvoller Wein mit intensiven Aromen und einem vollmundigen Charakter.',
            ],
        ],
    ],
    'acidity' => [
        'question' => 'Säure auf einer Skala von niedrig bis hoch?',
        'options' => [
            '1' => [
                'title' => 'Niedrig',
                'description' => 'Eins',
            ],
            '2' => [
                'title' => 'Nicht so viel',
                'description' => 'Zwei',
            ],
            '3' => [
                'title' => 'Mittel',
                'description' => 'Drei',
            ],
            '4' => [
                'title' => 'Nicht so hoch',
                'description' => 'Vier',
            ],
            '5' => [
                'title' => 'Hoch',
                'description' => 'Fünf',
            ],
        ],
    ],
    'tannin' => [
        'question' => 'Gerbstoff auf einer Skala von niedrig bis hoch?',
        'options' => [
            '1' => [
                'title' => 'Niedrig',
                'description' => 'Eins',
            ],
            '2' => [
                'title' => 'Nicht so viel',
                'description' => 'Zwei',
            ],
            '3' => [
                'title' => 'Mittel',
                'description' => 'Drei',
            ],
            '4' => [
                'title' => 'Nicht so hoch',
                'description' => 'Vier',
            ],
            '5' => [
                'title' => 'Hoch',
                'description' => 'Fünf',
            ],
        ],
    ],
    'maturation' => [
        'question' => 'Welchen Fassausbau bevorzugen Sie in einem Wein?',
        'options' => [
            'wood' => [
                'title' => 'Holz',
                'description' => '...',
            ],
            'steel' => [
                'title' => 'Stahl',
                'description' => '...',
            ],
        ],
    ],
];
