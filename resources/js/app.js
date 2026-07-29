import './bootstrap';
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
import Swal from 'sweetalert2';
window.Swal = Swal;

import './helpers';
import './theme';
import './toast';
import './ajax';
import './modal';
import './datatable';

import { createIcons, icons } from 'lucide';
document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });
});
