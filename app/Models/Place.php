<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', // Nom du lieu
        'address', // Adresse du lieu
        'latitude', // Coordonnées GPS (latitude)
        'longitude', // Coordonnées GPS (longitude)
        'capacity', // Capacité d'accueil du lieu
        'description', // Description du lieu
        'category', // Catégorie du lieu
        'facilities', // Équipements du lieu (peut être stocké en tant que JSON ou tableau)
        'accessibility', // Accessibilité du lieu
        'internal_rules', // Règles internes du lieu
        'photos', // Photos du lieu (peut être stocké en tant que JSON ou tableau)
        'website', // Site web du lieu
        'phone_number', // Numéro de téléphone du lieu
        'email', // Adresse e-mail de contact du lieu
        'social_media_links', // Liens vers les réseaux sociaux du lieu (peut être stocké en tant que JSON ou tableau)
        'rental_cost', // Coût de location du lieu
        'comments_and_reviews', // Commentaires et avis sur le lieu (peut être stocké en tant que JSON ou tableau)
        'past_events', // Événements passés au lieu (peut être stocké en tant que JSON ou tableau)
        'upcoming_events', // Événements à venir au lieu (peut être stocké en tant que JSON ou tableau)
        'internal_notes', // Notes internes pour la gestion du lieu
        'status', // Statut du lieu (ouvert, fermé, etc.)
        'opening_hours', // Horaires d'ouverture du lieu
        'parking_fees', // Tarifs de stationnement du lieu
        'catering_services', // Services de restauration du lieu
        'booking_conditions', // Conditions de réservation du lieu
    ];
    public function areas()
    {
        return $this->hasMany(Area::class); // Relation "hasMany" pour récupérer les salles liées au lieu
    }

    public function evenements()
    {
        return $this->hasMany(Evenement::class); // Relation "hasMany" pour récupérer les salles liées au lieu
    }
}
