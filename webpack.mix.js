let mix = require('laravel-mix');

mix.styles([
	'public/libs/bootstrap/css/bootstrap.min.css',
	'public/libs/bootstrap/css/bootstrap-grid.min.css',
	'public/assets/fonts/line-awesome/css/line-awesome.min.css',
	'public/assets/styles/themes/sidebar-black.min.css',
	'public/assets/fonts/montserrat/styles.css',
	'public/libs/tether/css/tether.min.css',
	'public/libs/jscrollpane/jquery.jscrollpane.css',
	'public/assets/styles/common.min.css',
	'public/assets/styles/themes/primary.min.css',
	'public/assets/fonts/kosmo/styles.css',
	'public/libs/noty/noty.css',
	'public/assets/styles/widgets/panels.min.css',
	'public/libs/bootstrap-daterange-picker/daterangepicker.css',
	'public/css/datatables.min.css'
],'public/css/lara-all.css');

mix.scripts([
	'public/libs/jquery/jquery.min.js',
	'public/libs/responsejs/response.min.js',
	'public/libs/loading-overlay/loadingoverlay.min.js',
	'public/libs/tether/js/tether.min.js',
	'public/libs/bootstrap/js/bootstrap.min.js',
	'public/libs/jscrollpane/jquery.jscrollpane.min.js',
	'public/libs/jscrollpane/jquery.mousewheel.js',
	'public/libs/flexibility/flexibility.js',
	'public/libs/noty/noty.min.js',
	'public/libs/velocity/velocity.min.js',
	'public/libs/momentjs/moment.min.js',
	'public/libs/bootstrap-daterange-picker/daterangepicker.js',
	'public/js/datatables.min.js',
	'public/js/jquery.geocomplete.min.js',
	'public/assets/scripts/common.min.js'
],'public/js/lara-all.js');
