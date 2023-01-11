require('./bootstrap');

import Alpine from 'alpinejs'
import Choices from 'choices.js';

window.Alpine = Alpine

Alpine.start()


// Create multiselect element
window.choices = (element) => {
    return new Choices(element, {
        maxItemCount: 3,
        removeItemButton: true,
    });
}
