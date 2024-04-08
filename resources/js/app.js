import './bootstrap';
import Alpine from 'alpinejs';
import Typewriter from '@marcreichel/alpine-typewriter';
import Chart from 'chart.js/auto';


window.Alpine = Alpine
Alpine.plugin(Typewriter);
Alpine.start()