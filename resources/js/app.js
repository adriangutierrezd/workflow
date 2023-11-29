import './bootstrap';

import jQuery from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;

import DataTable from 'datatables.net-dt';
window.DataTable = DataTable;

import * as echarts from 'echarts';
window.echarts = echarts

import Swal from 'sweetalert2'
window.Swal = Swal

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
