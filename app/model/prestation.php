<?php

namespace App\Model;

class Prestation
{
    private string $nom;
    private string $categorie;
    private string $artiste;
    private string $heure;
    private string $scene;
    private string $image;

    public function __construct(string $nom, string $categorie, string $artiste, string $heure, string $scene, string $image)
    {
        $this->nom = $nom;
        $this->categorie = $categorie;
        $this->artiste = $artiste;
        $this->heure = $heure;
        $this->scene = $scene;
        $this->image = $image;
    }

    public function getNom(): string { return $this->nom; }
    public function getCategorie(): string { return $this->categorie; }
    public function getArtiste(): string { return $this->artiste; }
    public function getHeure(): string { return $this->heure; }
    public function getScene(): string { return $this->scene; }
    public function getImage(): string { return $this->image; }

    public static function getAll(): array
    {
        return [
            new Prestation(
                'Drum & Bass Grooves',
                'DJ Set',
                'Wave motion',
                '10h00',
                'Temple Techno',
                'assets/img/scenes/temple_techno.jpg'
            ),
            new Prestation(
                'Ambient Morning Flow',
                'Live Set',
                'Luna sync',
                '10h00',
                'Jardin Chillout',
                'assets/img/scenes/jardin_chillout.jpg'
            ),
            new Prestation(
                'Warm-up: Deep House',
                'DJ Set',
                'Deep harmony',
                '11h00',
                'Scène Principale',
                'assets/img/scenes/main_stage_set.jpg'
            ),
            new Prestation(
                'Reggae/Dub Sessions',
                'DJ Set',
                'Glitch master',
                '11h00',
                'Jardin Chillout',
                'assets/img/scenes/jardin_chillout.jpg'
            ),
            new Prestation(
                'Hard Groove Set',
                'DJ Set',
                'NEXUS',
                '13h00',
                'Temple Techno',
                'assets/img/scenes/temple_techno.jpg'
            ),
            new Prestation(
                'Live Synthwave Pop',
                'Live Performance',
                'Cyber pulse',
                '14h00',
                'Scène Principale',
                'assets/img/scenes/main_stage_set.jpg'
            ),
            new Prestation(
                'Acid Live Performance',
                'Live Performance',
                'Deep harmony',
                '14h00',
                'Temple Techno',
                'assets/img/scenes/temple_techno.jpg'
            ),
            new Prestation(
                'Warm-up: Back to Back',
                'B2B Set',
                'Cyber pulse & Wave motion',
                '19h00',
                'Scène Principale',
                'assets/img/scenes/main_stage_set.jpg'
            ),
            new Prestation(
                'Neon Drift Experience',
                'Live Performance',
                'Luna sync',
                'Non programmée',
                '',
                'assets/img/scenes/main_stage_set.jpg'
            ),
            new Prestation(
                'Industrial Chaos',
                'DJ Set',
                'NEXUS',
                'Non programmée',
                '',
                'assets/img/scenes/temple_techno.jpg'
            ),
        ];
    }
}
