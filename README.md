
# BCC-Center — Starter e-learning (PHP + MySQL)

Une base prête à déployer sur un hébergement mutualisé (ByetHost, o2switch, etc.).
Fonctionnalités : comptes (admin/formateur/participant), dépôts d'exercices, consignes, forum, QCM, notes/badges, attestation.

## Installation rapide
1. **Créer la base MySQL** et importer `database/bcc_center.sql`.
2. **Adapter `config.php`** avec vos identifiants BD.
3. **Uploader tous les fichiers** sur votre hébergement (racine du site).
4. Ouvrez `/auth/login.php` et connectez-vous avec l'admin par défaut :
   - Email: `admin@example.com`
   - Mot de passe: `Admin123!` (changez-le immédiatement).

## Rôles
- **admin** : gestion globale (utilisateurs, formations, suivi).
- **formateur** : consignes, évaluations, QCM.
- **participant** : dépôts, QCM, notes, badges, attestation.

## QCM — Format JSON exemple
Collez ceci dans `Créér un QCM` :
```json
[
  {"question": "Quelle balise HTML pour un paragraphe ?", "options": ["<p>", "<div>", "<span>", "<h1>"], "answer": 0},
  {"question": "Quelle extension pour un fichier PHP ?", "options": [".js", ".py", ".php", ".css"], "answer": 2}
]
```

## Attestation
Page HTML imprimable (`attestations/view.php`). Pour un **PDF automatique** côté serveur, ajoutez une librairie (ex: **dompdf**) et remplacez la sortie HTML par un rendu PDF. 

## Forum
Simple threads + réponses. À structurer par formation si besoin (ajoutez un `course_id`).

## Arborescence
```
/auth, /admin, /formateur, /participant, /forum, /qcm, /notes, /attestations, /storage
```

## Sécurité (à améliorer en prod)
- Ajoutez **CSRF tokens** pour les formulaires sensibles.
- Vérifiez l’extension/MIME des fichiers uploadés.
- Déplacez `/storage` hors webroot si possible.
- Mettez des **règles d’éligibilité** réelles pour l’attestation.

## À faire / Extensions
- Liaison formations ↔ modules ↔ QCM.
- Tableau de bord avancé (progression).
- Export CSV/Excel.
- Intégration paiement/inscription.
- Emails (SMTP) pour notifications.

Bon dev !
