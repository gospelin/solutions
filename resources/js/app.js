import './main.js';
import './bootstrap';
import Alpine from 'alpinejs';
import $ from 'jquery';
import { gsap } from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
import TextPlugin from 'gsap/TextPlugin';
import i18next from 'i18next';

// Register GSAP plugins
gsap.registerPlugin(ScrollTrigger, TextPlugin);

// Expose libraries globally to match your existing setup
window.jQuery = window.$ = $;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;
window.TextPlugin = TextPlugin;
window.i18next = i18next;
window.Alpine = Alpine;

Alpine.start();

// Import your existing main.js (will be processed by Vite)
//import '../js/main.js';
