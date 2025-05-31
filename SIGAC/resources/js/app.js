import "./bootstrap";
import "bootstrap/dist/css/bootstrap.min.css";
import "../css/app.css"; // Arquivo de cores personalizadas do Bootstrap
import 'bootstrap'; 

// Chart.js (se necessário)
import Chart from 'chart.js/auto';
window.Chart = Chart;

// Alpine.js
import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();