<?php

namespace App\Model;

class Artiste
{
    private string $nom;
    private string $nomReel;
    private string $bio;
    private string $image;
    private array $styles;
    private array $programmation;

    public function __construct(string $nom, string $nomReel, string $bio, string $image, array $styles, array $programmation)
    {
        $this->nom = $nom;
        $this->nomReel = $nomReel;
        $this->bio = $bio;
        $this->image = $image;
        $this->styles = $styles;
        $this->programmation = $programmation;
    }

    public function getNom(): string { return $this->nom; }
    public function getNomReel(): string { return $this->nomReel; }
    public function getBio(): string { return $this->bio; }
    public function getImage(): string { return $this->image; }
    public function getStyles(): array { return $this->styles; }
    public function getProgrammation(): array { return $this->programmation; }

    public static function getAll(): array
    {
        return [
            new Artiste(
                'Cyber pulse',
                'Antoine Dupont',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus voluptates quas alias praesentium quod. Accusamus, illo.',
                'assets/img/artistes/cyber_pulse.jpg',
                ['Electro House', 'Future Rave'],
                ['14h00 - Live Synthwave Pop - Scène Principale', '19h00 - Warm-up: Back to Back - Scène Principale']
            ),
            new Artiste(
                'Deep harmony',
                'Sophie Martin',
                'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsa veritatis inventore laborum. Optio voluptas deleniti rerum consequuntur sus',
                'assets/img/artistes/deep_harmony.jpg',
                ['Deep House', 'Melodic Techno'],
                ['11h00 - Warm-up: Deep House - Scène Principale', '14h00 - Acid Live Performance - Temple Techno']
            ),
            new Artiste(
                'Glitch master',
                'Lucas Bernard',
                'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quia voluptate, debitis voluptatibus delectus faci',
                'assets/img/artistes/glitch_master.jpg',
                ['IDM', 'Glitch Hop'],
                ['11h00 - Reggae/Dub Sessions - Jardin Chillout']
            ),
            new Artiste(
                'Luna sync',
                'Emma Leroy',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur earum sapiente quibusdam voluptatum, natus eligendi temporibus.',
                'assets/img/artistes/luna_sync.jpg',
                ['Trance', 'Progressive House'],
                ['10h00 - Ambient Morning Flow - Jardin Chillout']
            ),
            new Artiste(
                'NEXUS',
                'Thomas Moreau',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis quidem pariatur accusantium doloremque voluptates quos repellat.',
                'assets/img/artistes/NEXUS.jpg',
                ['Techno', 'Hard Techno'],
                ['13h00 - Hard Groove Set - Temple Techno']
            ),
            new Artiste(
                'Wave motion',
                'Julie Dubois',
                'Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis inventore laudantium cumque quisquam aspernatur mollitia veritatis.',
                'assets/img/artistes/wave_motion.svg',
                ['Drum & Bass', 'Liquid Funk'],
                ['10h00 - Drum & Bass Grooves - Temple Techno', '19h00 - Warm-up: Back to Back - Scène Principale']
            ),
        ];
    }
}
