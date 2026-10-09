import './bootstrap';

import Alpine from 'alpinejs';
import savingsRateCalculator from './savings-rate-calculator';

window.Alpine = Alpine;

Alpine.data('savingsRateCalculator', savingsRateCalculator);

Alpine.start();
