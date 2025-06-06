@extends('layouts.app')

@section('title', 'Demander un séminaire')

@section('content')

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demander un séminaire</title>
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
        
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .form-header {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-light) 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .form-header h1 {
            font-size: 2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
        }
        
        .form-header i {
            background: rgba(255, 255, 255, 0.2);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .form-body {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .form-input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid var(--border);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.3);
            outline: none;
        }
        
        .form-input::placeholder {
            color: var(--text-light);
            opacity: 0.7;
        }
        
        .submit-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 16px 30px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.3);
        }
        
        .submit-btn:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(79, 70, 229, 0.4);
        }
        
        .form-footer {
            text-align: center;
            padding: 20px;
            border-top: 1px solid var(--border);
            color: var(--text-light);
        }
        
        .form-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }
        
        .form-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .info-box {
            background: rgba(129, 140, 248, 0.08);
            border-left: 4px solid var(--primary);
            padding: 15px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 25px;
            color: var(--text);
        }
        
        .info-box ul {
            padding-left: 20px;
            margin-top: 10px;
        }
        
        .info-box li {
            margin-bottom: 8px;
        }
        
        .info-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 10px;
        }
        
        @media (max-width: 768px) {
            .form-container {
                margin: 20px;
            }
            
            .form-header h1 {
                font-size: 1.6rem;
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-header">
            <h1>
                <i class="fas fa-microphone-alt"></i>
                Demander un nouveau séminaire
            </h1>
        </div>
        
        <div class="form-body">
            <div class="info-box">
                <div class="info-title">
                    <i class="fas fa-info-circle"></i>
                    Informations importantes
                </div>
                <p>Avant de soumettre votre demande, veuillez noter :</p>
                <ul>
                    <li>Votre demande sera examinée par le comité scientifique</li>
                    <li>La réponse sera communiquée dans un délai de 5 jours</li>
                    <li>Précisez un thème clair et descriptif</li>
                    <li>Vous pourrez ajouter le résumé après validation</li>
                </ul>
            </div>
            
            <form method="POST" action="{{ route('seminaire.store') }}">
                @csrf
                
                <div class="form-group">
                    <label for="theme">
                        <i class="fas fa-book-open"></i>
                        Thème du séminaire
                    </label>
                    <input id="theme" name="theme" type="text" 
                           class="form-input" 
                           placeholder="Ex: Les avancées récentes en intelligence artificielle"
                           required>
                </div>
                
                <div class="form-group">
                    <label for="resume">
                        <i class="fas fa-file-alt"></i>
                        Résumé (optionnel)
                    </label>
                    <textarea id="resume" name="resume" 
                              class="form-input" 
                              rows="4"
                              placeholder="Décrivez brièvement le contenu de votre séminaire..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="date">
                        <i class="fas fa-calendar"></i>
                        Date souhaitée (optionnel)
                    </label>
                    <input id="date" name="date" type="date" 
                           class="form-input">
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-paper-plane"></i>
                    Envoyer la demande
                </button>
            </form>
        </div>
        
        <div class="form-footer">
            <a href="{{ url()->previous() }}">
                <i class="fas fa-arrow-left"></i>
                Retour au tableau de bord
            </a>
        </div>
    </div>
</body>
</html>

@endsection