<!DOCTYPE html>
<html>
<head>
    <title>Notification de présentation</title>
</head>
<body>
    <h1>Bonjour {{ $presentation['presenter_name'] }} !</h1>
    
    <p>Votre présentation "<strong>{{ $presentation['title'] }}</strong>" a été programmée :</p>
    
    <ul>
        <li>Date : {{ $presentation['date']->format('d/m/Y H:i') }}</li>
        <li>Salle : {{ $presentation['room'] }}</li>
    </ul>
    
    <p>Merci de soumettre votre résumé avant le {{ $presentation['abstract_deadline']->format('d/m/Y') }}</p>
    
    <footer>
        Secrétariat Scientifique IMSP
    </footer>
</body>
</html>