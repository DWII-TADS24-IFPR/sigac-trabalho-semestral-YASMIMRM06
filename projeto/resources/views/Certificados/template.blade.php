<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Declaração de Horas Complementares</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .content { margin: 40px 0; line-height: 1.6; }
        .signature { margin-top: 60px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>INSTITUTO FEDERAL DO PARANÁ - CAMPUS PARANAGUÁ</h2>
        <h3>DECLARAÇÃO DE HORAS COMPLEMENTARES</h3>
    </div>
    
    <div class="content">
        <p>Declaramos que <strong>{{ $user->name }}</strong>, matrícula <strong>{{ $user->registration }}</strong>, 
        do curso <strong>{{ $user->course->name }}</strong>, cumpriu um total de <strong>{{ $totalHours }} horas</strong> 
        em atividades complementares até a presente data.</p>
    </div>
    
    <div class="signature">
        <p>Paranaguá, {{ $date }}</p>
        <p>_________________________________________</p>
        <p>Coordenação de Curso</p>
    </div>
</body>
</html>