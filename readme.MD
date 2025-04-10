# 🎬 MovieRating – Filmbewertung mit Laravel TALL Stack

Ein modernes, performantes Film-Bewertungsportal mit Laravel, Livewire und OMDb API.

## 📋 Aufgabenstellung

Ziel des Projekts ist es, eine Applikation mit dem **TALL Stack** (Tailwind CSS, Alpine.js, Laravel, Livewire) zu entwickeln, die die Suche und Bewertung von Filmen ermöglicht.

Die Kernfunktionen sind:

- **🔐 Registrierung & Login**: Benutzer können sich registrieren und im geschützten Bereich anmelden.
- **🔎 Filmbasierte Suche**: Integration der **OMDb API**, um Filme per Titel suchen und anzeigen zu können.
- **⭐ Filmbewertung**: Nutzer können Filme bewerten (1–5). Eine **Durchschnittsbewertung** wird aus allen User-Ratings berechnet (nicht zu verwechseln mit IMDb oder Metascore).
- **🗂️ Bewertete Filme**: Jeder User kann seine eigenen bewerteten Filme in einer Liste einsehen.
- **💡 Fokus auf Technik**: Die technische Architektur steht über der optischen Gestaltung. Ziel ist eine **performante**, **ressourcenschonende**, **API-effiziente** Lösung.

---

## ⚙️ Verwendete Technologien

- **Laravel 10**
- **Livewire 3**
- **Tailwind CSS**
- **Docker (Laravel Sail)**
- **MySQL (inkl. Test-Datenbank)**
- **OMDb API** für Filmdaten

---

## 🧠 Herausforderungen & Lösungsansätze

### 1. **API-Limitierungen umgehen (OMDb 1.000 Requests/Tag)**
- Suchen & Detailabrufe werden **separat gecacht**
- **Such-IDs** werden 24h im Cache gehalten (`search:final-destination`)
- Nur nicht vorhandene Filme werden synchronisiert

### 2. **Trennung von API-Logik und Geschäftslogik**
- Eigener **OmdbApiService** für alle externen Calls
- Separater **MovieSearchService** übernimmt Caching, DB-Sync und internes Handling
- Saubere Trennung für **Wartbarkeit & Tests**

### 3. **Performante Datenhaltung & Reduktion von API Calls**
- `syncMissingMovies()` verhindert doppelte API-Calls
- Ratings via `updateOrCreate()` abgewickelt, um Duplikate zu vermeiden
- Durchschnittsbewertung wird bei Bedarf via `withAvg('ratings', 'rating')` abgerufen

### 4. **Live-Komponenten & dynamische UI**
- **MovieSearch** als Livewire-Komponente
- **MovieRating** mit Inline-Bewertung und Live-Feedback
- Livewire Policies sichern Bewertungen ab

### 5. **Testing mit Pest & Docker**
- Eigene `.env.testing`
- **Pest-Tests** für Services und Logik

---

## 🧪 Setup & Testing

```bash
# 1. Starte Laravel Sail
./vendor/bin/sail up -d

# 2. Installiere Abhängigkeiten
./vendor/bin/sail composer install
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev (für lokale Entwicklung)
./vendor/bin/sail artisan migrate

# 3. Starte Tests (Pest)
./vendor/bin/sail test
