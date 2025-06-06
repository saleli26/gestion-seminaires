@extends('layouts.app')

@section('title', 'Tableau de bord Présentateur')

@section('content')

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Présentateur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --primary-dark: #3730a3;
            --secondary: #f9fafb;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --text: #1f2937;
            --text-light: #6b7280;
            --border: #e5e7eb;
            --card-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e6f7ff 100%);
            min-height: 100vh;
            padding: 20px;
            color: var(--text);
        }
        
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid rgba(79, 70, 229, 0.1);
        }
        
        .header-left h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .header-left h1 i {
            background: var(--primary);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .add-seminar-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
        }
        
        .add-seminar-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(79, 70, 229, 0.4);
        }
        
        .seminar-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .seminar-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .seminar-header {
            padding: 20px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .seminar-header h3 {
            font-size: 1.4rem;
            font-weight: 600;
            max-width: 70%;
        }
        
        .seminar-date {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .seminar-body {
            padding: 20px;
        }
        
        .seminar-info {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 16px;
            border-radius: 8px;
            background: var(--secondary);
        }
        
        .info-item i {
            width: 24px;
            color: var(--primary);
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .status-approved {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
        }
        
        .status-pending {
            background: rgba(245, 158, 11, 0.15);
            color: var(--warning);
        }
        
        .status-rejected {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
        }
        
        .resume-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid var(--border);
        }
        
        .view-resume-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(79, 70, 229, 0.1);
            color: var(--primary);
            padding: 8px 16px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        
        .view-resume-btn:hover {
            background: rgba(79, 70, 229, 0.2);
        }
        
        .upload-form {
            background: #f9fafb;
            padding: 20px;
            border-radius: 12px;
            margin-top: 10px;
        }
        
        .upload-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: var(--text-light);
        }
        
        .upload-wrapper {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .file-input {
            flex: 1;
            min-width: 200px;
            padding: 10px;
            border: 1px solid var(--border);
            border-radius: 8px;
            background: white;
        }
        
        .upload-btn {
            background: var(--success);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background 0.2s ease;
        }
        
        .upload-btn:hover {
            background: #0da271;
        }
        
        .no-resume {
            color: var(--text-light);
            font-style: italic;
            padding: 10px;
            background: var(--secondary);
            border-radius: 8px;
            display: inline-block;
        }
        
        .seminar-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 40px;
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
        }
        
        .empty-state i {
            font-size: 3.5rem;
            color: var(--primary-light);
            margin-bottom: 20px;
            background: rgba(129, 140, 248, 0.1);
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        .empty-state h3 {
            font-size: 1.8rem;
            margin-bottom: 15px;
            color: var(--primary-dark);
        }
        
        .empty-state p {
            color: var(--text-light);
            margin-bottom: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1.1rem;
            line-height: 1.6;
        }
        
        .empty-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        .empty-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(79, 70, 229, 0.4);
        }
        
        .date-remaining {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(129, 140, 248, 0.1);
            padding: 6px 12px;
            border-radius: 20px;
            color: var(--primary);
            font-weight: 500;
            margin-top: 10px;
        }
        
        @media (max-width: 768px) {
            .seminar-grid {
                grid-template-columns: 1fr;
            }
            
            .header-left h1 {
                font-size: 1.5rem;
            }
            
            .seminar-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .seminar-header h3 {
                max-width: 100%;
            }
            
            .upload-wrapper {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <header>
            <div class="header-left">
                <h1><i class="fas fa-chalkboard-teacher"></i> Mes Séminaires</h1>
            </div>
            <a href={{ route('seminaire.create') }} class="add-seminar-btn">
                <i class="fas fa-plus"></i> Demander un séminaire
            </a>
        </header>
        
        <div class="seminar-grid">
    @if($seminaires->isEmpty())
        <div class="empty-state">
            <i class="fas fa-chalkboard"></i>
            <h3>Aucun séminaire prévu</h3>
            <p>Vous n'avez pas encore demandé de séminaire. Cliquez sur le bouton ci-dessous pour en créer un.</p>
            <a href="{{ route('seminaire.create') }}" class="empty-btn">
                <i class="fas fa-plus"></i> Demander un séminaire
            </a>
        </div>
    @else
        @foreach($seminaires as $seminaire)
            <div class="seminar-card">
                <div class="seminar-header">
                    <h3>{{ $seminaire->theme }}</h3>
                    @if($seminaire->date)
                        <div class="seminar-date">
                            <i class="fas fa-calendar"></i>
                            {{ \Carbon\Carbon::parse($seminaire->date)->format('d/m/Y') }}
                        </div>
                    @endif
                </div>
                <div class="seminar-body">
                    <div class="seminar-info">
                        <div class="info-item">
                            <i class="fas fa-user"></i>
                            <div>{{ Auth::user()->name }}</div>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                @if($seminaire->date)
                                    @php
                                        $daysRemaining = \Carbon\Carbon::parse($seminaire->date)->diffInDays(now());
                                    @endphp
                                    <div>{{ $seminaire->heure ? \Carbon\Carbon::parse($seminaire->heure)->format('H:i') : '-' }}</div>
                                    @if(\Carbon\Carbon::parse($seminaire->date)->isPast())
                                        Passé
                                    @else
                                        Prévu dans {{ $daysRemaining }} jours
                                    @endif
                                @else
                                    Date non définie
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Badge d'état -->
                    @if($seminaire->statut == 'validé')
                        <div class="status-badge status-approved">
                            <i class="fas fa-check-circle"></i> Validé
                        </div>
                    @elseif($seminaire->statut == 'en_attente')
                        <div class="status-badge status-pending">
                            <i class="fas fa-hourglass-half"></i> En attente
                        </div>
                    @elseif($seminaire->statut == 'rejeté')
                        <div class="status-badge status-rejected">
                            <i class="fas fa-times-circle"></i> Rejeté
                        </div>
                    @endif
                    
                    <!-- Section résumé -->
                    <div class="resume-section">
                        @if($seminaire->statut == 'validé')
                            @if($seminaire->fichier)
                                <a href="{{ asset('storage/' . $seminaire->fichier) }}"
                                   class="view-resume-btn"
                                   target="_blank">
                                    <i class="fas fa-file-pdf"></i> Voir le résumé
                                </a>
                                <div class="date-remaining">
                                    <i class="fas fa-bell"></i> 
                                    Résumé publié le {{ $seminaire->updated_at->format('d/m/Y') }}
                                </div>
                            @else
                                <div class="upload-form">
                                    <form action="{{ route('seminaire.upload', $seminaire->id) }}" 
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <label for="resume-file-{{ $seminaire->id }}">
                                            <i class="fas fa-file-upload"></i> Ajouter le résumé (PDF uniquement)
                                        </label>
                                        <div class="upload-wrapper">
                                            <input type="file" 
                                                   class="file-input" 
                                                   id="resume-file-{{ $seminaire->id }}"
                                                   name="fichier"
                                                   accept="application/pdf">
                                            <button type="submit" class="upload-btn">
                                                <i class="fas fa-cloud-upload-alt"></i> Télécharger
                                            </button>
                                        </div>
                                        @if($seminaire->date)
                                            <div class="date-remaining">
                                                <i class="fas fa-exclamation-circle"></i>
                                                Date limite : {{ \Carbon\Carbon::parse($seminaire->date)->subDays(7)->format('d/m/Y') }}
                                            </div>
                                        @endif
                                    </form>
                                </div>
                            @endif
                        @elseif($seminaire->statut == 'en_attente')
                            <div class="no-resume">
                                <i class="fas fa-info-circle"></i> Résumé à ajouter après validation
                            </div>
                        @elseif($seminaire->statut == 'rejeté')
                            <div class="no-resume">
                                <i class="fas fa-info-circle"></i> Séminaire non validé - Veuillez contacter le secrétariat
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
    </div>
</body>
</html>

@endsection