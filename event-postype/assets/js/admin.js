jQuery(document).ready(function() {
  jQuery("#events_date").persianDatepicker({
    observer: true,
		format: 'dddd,DD MMMM YYYY',
		autoClose: true,
		altField: '#events_date_int',
		initialValue: false,
		calendar:{
			persian: {
				locale: 'en'
			}
		},
  });
});